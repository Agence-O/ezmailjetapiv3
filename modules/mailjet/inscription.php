<?php
$ini            = eZINI::instance('mailjet.ini');

$listID         = $ini->variable('MailjetSettings','ListID');
$apiKey         = $ini->variable('MailjetSettings','ApiKey');
$apiSecretKey   = $ini->variable('MailjetSettings','ApiSecretKey');

$mailjet        = new Mailjet($apiKey, $apiSecretKey);
$email          = $Params['e-mail'];

function mailjetStatusCode($response_code){
    switch($response_code){
        case 200:
            $status = "OK.";
            break;
        case 201:
            $status = "A new insertion was done.";
            break;
        case 204:
            $status = "No content found or expected to return.";
            break;
        case 304:
            $status = "Nothing was modified.";
            break;
        case 400:
            $status = "One or more arguments are missing or maybe mispelling.";
            break;
        case 401:
            $status = "You have specified an incorrect ApiKey.";
            break;
        case 404:
            $status = "The method your are trying to reach don't exists.";
            break;
        case 405:
            $status = "You made a POST request instead of GET, or the reverse.";
            break;
        default:
            $status = "An unknow error occurs.";
    }
    return $status;
}

// We try to create a new contact
$paramsCreateContact = array(
    "method" => "POST",
    "Email" => $email
);
$resultCreateContact = $mailjet->contact($paramsCreateContact);

$returnCreateContact = [
    'result'        => $resultCreateContact,
    'response_code' => $mailjet->_response_code,
    'message'       => mailjetStatusCode($mailjet->_response_code)
];

// We get the contact's id by his e-mail
$paramsGetContact = [
    "method"    => "VIEW",
    "ID"        => $email
];
$resultGetContact = $mailjet->contact($paramsGetContact);

$result = [
    'result'        => $resultGetContact,
    'response_code' => $mailjet->_response_code,
    'message'       => $message = mailjetStatusCode($mailjet->_response_code)
];

if($resultGetContact != false){
    $contactID = $resultGetContact->Data[0]->ID;

    $paramsAddContactToList =[
        "method"    => "POST",
        "ContactID" => $contactID,
        "ListID"    => $listID,
        "IsActive"  => "True"
    ];

    $resultAddContactToList = $mailjet->listrecipient($paramsAddContactToList);

    if($mailjet->_response_code === 400)
        $message = "You have already subscribed, thank you for your interest.";
    elseif($mailjet->_response_code === 201)
        $message = "You have successfully subscribed to our newsletter, thank you !";

    $result = [
        'result'        => $resultAddContactToList,
        'response_code' => $mailjet->_response_code,
        'message'       => $message
    ];
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($result);
eZExecution::cleanExit();