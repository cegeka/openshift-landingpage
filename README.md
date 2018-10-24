# Build locally
s2i build . centos/php-71-centos7 demoapp
```
---> Installing application source...
=> sourcing 20-copy-config.sh ...
---> 13:59:36     Processing additional arbitrary httpd configuration provided by s2i ...
=> sourcing 00-documentroot.conf ...
=> sourcing 50-mpm-tuning.conf ...
=> sourcing 40-ssl-certs.sh ...
Build completed successfully
```

docker run -e CUSTOMER=somecustomer -p 8080:8080 demoapp
```
=> sourcing 20-copy-config.sh ...
---> 13:59:42     Processing additional arbitrary httpd configuration provided by s2i ...
=> sourcing 00-documentroot.conf ...
=> sourcing 50-mpm-tuning.conf ...
=> sourcing 40-ssl-certs.sh ...
AH00558: httpd: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
[Tue Oct 23 13:59:42.562159 2018] [ssl:warn] [pid 1] AH01909: 172.17.0.2:8443:0 server certificate does NOT include an ID which matches the server name
```

# Deploy on openshift
## Create the templates
oc create -f openshift-template.yaml -n <yournamespace>
```
template "openshift-landingpage" created
```
oc create -f openshift-template-persistent.yaml -n <yournamespace>
```
template "openshift-landingpage" created
```
## Deploy from the template
oc new-app --template=openshift-landingpage -p CUSTOMER=yourcustomer
```
--> Deploying template "fabian/openshift-landingpage" to project fabian

     PHP landing page
     ---------
     An example landing page that serves PHP content. For more information about using this template, including OpenShift considerations, see https://github.com/cegeka/openshift-landingpage/blob/master/README.md.

     The following service(s) have been created in your project: openshift-landingpage.

     For more information about using this template, including OpenShift considerations, see https://github.com/cegeka/openshift-landingpage/blob/master/README.md.

     * With parameters:
        * Name=openshift-landingpage
        * Customer name=yourcustomer
        * Namespace=openshift
        * PHP Version=7.1
        * Memory Limit=512Mi
        * Git Repository URL=https://github.com/cegeka/openshift-landingpage.git
        * Git Reference=
        * Context Directory=/app
        * Application Hostname=
        * GitHub Webhook Secret=aHcSauKT1B7raqtTHiVaHYE5fBTajdWyxWJujQfi # generated
        * Generic Webhook Secret=GfckyriMQfo7ye105YhT2jcWGC5tTEwY4keCRSrv # generated

--> Creating resources ...
    service "openshift-landingpage" created
    route "openshift-landingpage" created
    imagestream "openshift-landingpage" created
    buildconfig "openshift-landingpage" created
    deploymentconfig "openshift-landingpage" created
--> Success
    Access your application via route 'openshift-landingpage-fabian.apps.openshift-acc.cegeka.com'
    Build scheduled, use 'oc logs -f bc/openshift-landingpage' to track its progress.
    Run 'oc status' to view your app.
```
