<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

function slackNotification($message) {
    $curl = curl_init();

    $options = array(
        CURLOPT_POST => TRUE,
        CURLOPT_URL => "[slack_api_url]",
        CURLOPT_POSTFIELDS => 'payload={"text": "' . $message . '", "username": "Deployment Status", "icon_emoji": ":zap:"}'
    );
    curl_setopt_array($curl, $options);

    curl_exec($curl);
    curl_close($curl);
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deploy', function () {
    return view('deploy');
});

Route::get('/deploy/exec', function () {

    $cf = '[cf_bash_path] ';

    $commands = array(
        'cd [project_path]',
        $cf . 'login -a https://api.ng.bluemix.net -u [username] -p ' . env('bluemix-password') . ' -o [organization] -s [space]',
        $cf . 'push ' . $_GET['env'],
        $cf . 'logout'
    );

    $commands = implode(';', $commands);

    exec($commands, $output, $status);

    if ($status === 0) {
        slackNotification('Your application was successfully deployed to ' . $_GET['env']);
        return $output;
    } else {
        slackNotification('There was an *error* deploying your application to ' . $_GET['env']);
        return 'error';
    }
});
