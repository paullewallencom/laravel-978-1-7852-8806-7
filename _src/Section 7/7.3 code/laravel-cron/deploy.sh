#!/bin/bash
cd [project_path]
cf login -a https://api.ng.bluemix.net -u [username] -p [password] -o [organization] -s [space]
cf push [application_name]
cf logout
