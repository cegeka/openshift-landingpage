<?php
// BEGIN CONFIGURATION ////////////////////////////////////////////////
define('EMAIL_TO', 'your-email@address.com');
define('EMAIL_SUBJECT', 'Test Subject');
define('CAPTCHA_ENABLED', '1'); // 0 - Disabled, 1 - Enabled
// END CONFIGURATION ////////////////////////////////////////////////
define('CAPTCHA1', rand(1,9));
define('CAPTCHA2', rand(1,9));

function slack($message) {
    $hook = getenv('SLACK_HOOK');
    $ch = curl_init($hook);
    $data = '{ "text": "' . $title . '",
      "blocks": [
        { "type": "section",
          "text": {
            "type": "mrkdwn",
            "text": "' . $message . '"
          }
        }
      ]
    }';
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($message))
    );
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$feedback_show = "d-none";
$feedback_type = "alert-primary";

if(!empty($_POST)){
  $captcha = htmlspecialchars(stripslashes(trim($_POST['captcha'])));
  $captcha1 = htmlspecialchars(stripslashes(trim($_POST['captcha1'])));
  $captcha2 = htmlspecialchars(stripslashes(trim($_POST['captcha2'])));

  if (($captcha1 + $captcha2) != $captcha) {
    $feedback = 'Captcha incorrect! Please try again.';
    $feedback_show = "d-block";
    $feedback_type = "alert-danger";
  } else {

    $company = htmlspecialchars(stripslashes(trim($_POST['company'])));
    $name = htmlspecialchars(stripslashes(trim($_POST['name'])));
    $phone = htmlspecialchars(stripslashes(trim($_POST['phone'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $cloudlocation = htmlspecialchars(stripslashes(trim($_POST['cloudLocation'])));
    $consultancyrequired = htmlspecialchars(stripslashes(trim($_POST['consultancyRequired'])));
    $cicd = htmlspecialchars(stripslashes(trim($_POST['cicd'])));
    $training = htmlspecialchars(stripslashes(trim($_POST['training'])));
    $sysdig = htmlspecialchars(stripslashes(trim($_POST['sysdig'])));
    $remarks = htmlspecialchars(stripslashes(trim($_POST['remarks'])));

    $input_msg = <<<EOF
{
  "blocks": [{
      "type": "section",
      "text": {
        "type": "mrkdwn",
        "text": "The OpenShift contact form has been submitted :metal:"
      }
    },
    {
      "type": "section",
      "fields": [{
          "type": "mrkdwn",
          "text": "*Name:*\n$name"
        },
        {
          "type": "mrkdwn",
          "text": "*Company:*\n$company"
        },
        {
          "type": "mrkdwn",
          "text": "*Email:*\n$email"
        },
        {
          "type": "mrkdwn",
          "text": "*Phone:*\n$phone"
        }
      ]
    },
    {
      "type": "divider"
    },
    {
      "type": "section",
      "fields": [{
          "type": "mrkdwn",
          "text": "*Install type:*\n$cloudlocation"
        },
        {
          "type": "mrkdwn",
          "text": "*Consultancy required:*\n$consultancyrequired"
        }
      ]
    },
    {
      "type": "divider"
    },
    {
      "type": "section",
      "fields": [{
          "type": "mrkdwn",
          "text": "*OpenShift training:*\n$training"
        },
        {
          "type": "mrkdwn",
          "text": "*Sysdig required:*\n$sysdig"
        },
        {
          "type": "mrkdwn",
          "text": "*CI/CD consultancy:*\n$cicd"
        }
      ]
    },
    {
      "type": "divider"
    },
    {
      "type": "section",
      "fields": [{
          "type": "mrkdwn",
          "text": "*Remarks:*\n$remarks"
        }
      ]
    }
  ]
}
EOF;

    $return_msg = slack($input_msg);
    if ($return_msg == "ok") {
      $feedback_show = "d-block";
      $feedback = "Thanks for contacting us " . $name . ", we'll call you as soon as possible.";
    } else {
      $feedback_show = "d-block";
      $feedback_type = "alert-warning";
      $feedback = "Something went wrong while submitting your request, please try again later. Contact openshift@cegeka.com is this problem persists.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/style.css">
</head>
<body>

        <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <a class="navbar-logo" href="https://www.cegeka.com/en/be/"><img src="/images/cegeka_logo_resize_128.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="work"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">OpenShift <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://www.cegeka.com/en/be/devops-automation">Solutions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Industries</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.cegeka.com/en/be/in-close-cooperation/outsourcing-and-managed-services">In close cooperation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.cegeka.com/jobs-belgium-netherlands">Careers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.cegeka.com/en/be/about-us/our-story">About us</a>
                  </li>
              </ul>
            </div>
          </nav>
          </div>

  <section class="welcome pt-9 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 col-lg-6 order-md-2">
                <img src="/images/devops.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="work">
            </div>
            <div class="col-12 col-md-7 col-lg-6 order-md-1">
                <h1 class="display-5 text-center text-md-left">
                    DevOPs on
                    <span class="text-primary">OpenShift</span>.
                   <br>
                   Enterprise container hosting
                </h1>
                <p class="lead text-center text-md-left text-muted mb-6 mb-lg-8">
                        Your OpenShift DevOPs platform installed by Cegeka. Deploy cloud-ready applications fast in containers using the OpenShift self-service portal.
                      </p>
            </div>
        </div>
    </div>
</section>

  <section class="form pt-9">
    <div class="container">
      <div class="alert <?php echo $feedback_type; ?> <?php echo $feedback_show; ?>" role="alert">
        <?php echo $feedback; ?>
        </div>
        <div class="row align-items-center">

          <form action="/get-openshift/" method="post">
            <p class="h5">How can we get in touch with you?</p>
            <div class="form-row">
            <div class="col-md-2 mb-3">
              <label for="inputCompany">Company</label>
              <input type="text" class="form-control" name="company" id="inputCompany" aria-describedby="inputCompany" placeholder="">
            </div>
            <div class="col-md-3 mb-3">
              <label for="inputName">Name</label>
              <input type="text" class="form-control" name="name" id="inputName" aria-describedby="inputName" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="inputEmail">Email address</label>
              <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="inputEmail" placeholder="" required>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="col-md-2 mb-3">
              <label for="inputPhone">Phone</label>
              <input type="text" class="form-control" name="phone" id="inputPhone" aria-describedby="inputPhone" required>
            </div>
          </div>

          <p class="h5">Where do you want to host your OpenShift platform?</p>
          <div class="form-row">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="radio" name="cloudLocation" id="onpremise" value="onpremise">
              <label class="form-check-label" for="onpremise">
                On-premise
              </label>
              </div>
              <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="radio" name="cloudLocation" id="cloud" value="cloud">
              <label class="form-check-label" for="cloud">
                Cloud
              </label>
            </div>
            </div>
          </div>

          <p class="h5">Will you require consultancy on how to use the platform?</p>
          <div class="form-row">
          <div class="form-group">
              <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="radio" name="consultancyRequired" id="consultancy" value="true">
              <label class="form-check-label" for="consultancy">
                Yes
              </label>
              </div>
              <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="radio" name="consultancyRequired" id="noconsultancy" value="false">
              <label class="form-check-label" for="noconsultancy">
                No
              </label>
            </div>
          </div>
        </div>
          <p class="h5">Do you need additional features?</p>
          <div class="form-row">
            <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="checkbox" name="cicd" id="checkboxCICD">
              <label class="form-check-label" for="checkboxCICD">
                Help with setting up a CI / CD pipeline
              </label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="checkbox" name="training" id="checkboxTraining">
              <label class="form-check-label" for="checkboxTraining">
                Training - x-day OpenShift
              </label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="form-check-input" type="checkbox" name="sysdig" id="checkboxSysdig">
              <label class="form-check-label" for="checkboxSysdig">
                End-to-end Monitoring - powered by Sysdig
              </label>
            </div>
          </div>
          </div>

          <p class="h5">Do you have additional remarks?</p>
          <div class="form-row">
            <div class="col-md-10 form-group">
            <label for="inputRemarks">Remarks</label>
            <input type="text" class="form-control" name="remarks" id="inputRemarks" aria-describedby="inputRemarks" placeholder="">
            </div>
          </div>

          <div class="form-row">
          <div class="col-md-2 mb-3">
            <label for="inputCompany">Captcha: <?php echo CAPTCHA1; ?> + <?php echo CAPTCHA2; ?> = ?</label>
              <input type="text" class="form-control" name="captcha" id="inputCaptcha" aria-describedby="inputCaptcha" required>
              <input type="hidden" name="captcha1" value="<?php echo CAPTCHA1; ?>" />
              <input type="hidden" name="captcha2" value="<?php echo CAPTCHA2; ?>" />
            </div>
          </div>

          <div class="form-row">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
          </div>
        </div>
        </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
