<?
/////Table//////////////
define(TABLE_PRE, "juliasheasurvey_");
define(TABLE_ADMIN, TABLE_PRE."admin");
define(TABLE_CONTENT, TABLE_PRE."content");
define(TABLE_SURVEYTYPE, TABLE_PRE."surveytype");
define(TABLE_SURVEY, TABLE_PRE."survey");
define(TABLE_QUESTION, TABLE_PRE."question");
define(TABLE_OPTION, TABLE_PRE."option");
define(TABLE_INDUSTRY, TABLE_PRE."industry");
define(TABLE_CLIENT, TABLE_PRE."client");
define(TABLE_SURVEY_CLIENT, TABLE_PRE."survey_client");
define(TABLE_SURVEY_CLIENT_USER, TABLE_PRE."survey_client_user");
define(TABLE_SURVEY_USER, TABLE_PRE."survey_user");
define(TABLE_SURVEY_TAKERINFO, TABLE_PRE."survey_takerinfo");
define(TABLE_SURVEY_ANSWER, TABLE_PRE."survey_answer");
define(TABLE_SURVEY_ANSWERINFO, TABLE_PRE."survey_answerinfo");
define(TABLE_SURVEY_QUESTION, TABLE_PRE."survey_question");
define(TABLE_SURVEY_QUESTIONINFO, TABLE_PRE."survey_questioninfo");
define(TABLE_INFODD, TABLE_PRE."infodd");
define(TABLE_SURVEY_ANSWER_BACKUP, TABLE_PRE."answer_backup");
///////////Path////////
define(CLASSES,'classes/');
////Message//////
define(INVALID_LOGIN, "Please input correct user name and password!");
define(PASSWORD_MISMATCH, "Sorry! Password mismatching occured!");
define(UPDATE, "Record Updated!");
define(INSERT, "Record Inserted!");
define(DELETE, "Record Deleted!");
define(CHECKONE, "Check atleast one!");
define(EMAIL_EXIST, "This EMAIL ID is already registered. Please try again.");
define(INVALID_IMAGE_FORMAT, "Please enter a valid image format(e.g- GIF,JPG or PNG)!");
define(FORGOT_PASS, "Password has been sent to your email account!");
define(INVALID_EMAIL, "Invalid Email ID Entered!");
define(CLIENT_LOGO, "client/logo/");
define(CLIENT_BANNER, "client/banner/");
define(USER_LIST, "client/user_list/");
define(SURVEY_INST_DOC, FURL."direction/clientsurveydirections.doc");
define(COMMENTESSAY_DOC, "comess/");
define(AGGANS, "aggans/");
define(FULLRESULT, "fullresult/");
define(EMAILCODE, "emailcode/");
//others
define(SITE_NAME, "Control Panel- JuliaShea.com");
define(CLIENT_SITE_NAME, "Client Panel- JuliaShea.com");
define(WEBSITE_NAME, "JuliaShea.com");
define(ADMIN_EMAIL, "demoforclient@gmail.com");
define(NOREPLY_EMAIL, "noreply@juliashea.com");
define(SURVEY_EMAIL, "surveys@juliashea.com");
define(FOOTER_TEXT, "Copyright &copy; ".date("Y")." JuliaShea, Inc, All rights reserved.");
?>