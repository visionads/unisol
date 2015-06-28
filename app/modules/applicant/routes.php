<?php

//***********************Applicant Sign up Start(R)**********************

//Route::get('applicant/registration',
//    'ApplicantController@applicant_signup'
//);
Route::any("/applicant", [
    "as"   => "applicant",
    "uses" => "ApplicantController@index"
]);


Route::any('applicant/details',
    ['as' => 'applicant.details',
        'uses' => 'ApplicantController@applicantDetails']);

Route::any("applicant/signup", [
    "as"   => "applicant.signup",
    "uses" => "ApplicantController@signup"
]);

Route::any('applicant/store',
    'ApplicantController@applicant_signup_data_save'
);

Route::get('register/verify/{verified_code}',
    'ApplicantController@applicant_signup_confirm'
);

Route::group( array('after' => 'auth'), function(){


//********************Change Password Start(R)****************************

Route::any('applicant/change/password',
    'ApplicantController@applicant_change_password'
);

Route::any('applicant/change_password/update',
    'ApplicantController@applicant_change_password_update'
);

//********************User Account(R)*************************************

Route::any('applicant/user-account/info',
    'ApplicantController@userAccountInfoIndex'
);

Route::any('applicant/user-account/edit/{id}',
    'ApplicantController@userAccountEdit'
);

Route::post('applicant/user-account/update/{id}',
    'ApplicantController@userAccountUpdate'
);

//********************Applicant Profile(R)*******************************

Route::any('applicant/profile/',
    'ApplicantController@applicantProfileIndex'
);

Route::any('applicant/profile/store',
    'ApplicantController@applicantProfileStore'
);

Route::any('applicant/profile/edit/{id}',
'ApplicantController@editApplicantProfile'
);

Route::post('applicant/profile/update/{id}',
    'ApplicantController@updateApplicantProfile'
);

Route::any('applicant/profile_image/edit/{id}',
    'ApplicantController@editProfileImage'
);
Route::any('applicant/profile_image/update/{id}',
    'ApplicantController@updateProfileImage'
);
//********************Applicant Academic Records(R)**********************

Route::any('applicant/acm_records/',
    'ApplicantController@acmRecordsIndex'
);

Route::any('apt/acm_records/store',
    'ApplicantController@acmRecordsStore'
);

Route::any('apt/acm_records/show/{id}',
    'ApplicantController@acmRecordsShow'
);

Route::any('apt/acm_records/edit/{id}',
    'ApplicantController@acmRecordsEdit'
);
Route::any('apt/acm_records/update/{id}',
    'ApplicantController@acmRecordsUpdate'
);
Route::any('apt/acm_records/delete/{id}',
    'ApplicantController@academicDelete'
);

//*********************Applicant Meta Information/Personal Info(R)**********

Route::any('applicant/personal_info/',
    'ApplicantController@personalInfoIndex'
);

Route::any('apt/personal_info/store',
    'ApplicantController@personalInfoStore'
);

Route::any('apt/personal_info/edit/{id}',
    'ApplicantController@personalInfoEdit'
);

Route::any('apt/personal_info/update/{id}',
    'ApplicantController@personalInfoUpdate'
);

Route::any('applicant/personal_info_signature/edit/{id}',
    'ApplicantController@edit_signature'
);
Route::any('applicant/personal_info_signature/update/{id}',
    'ApplicantController@update_signature'
);

//******************Applicant Supporting Docs(R)*************************

Route::any('applicant/supporting_docs/',
    'ApplicantController@sDocsIndex'
);

Route::any('apt/supporting_docs/view/{doc_type}/{sdoc_id}', [
    'as'   => 'applicant.supporting_docs.view',
    'uses' => 'ApplicantController@sDocsView'
]);

Route::any('apt/supporting_docs/store',
    'ApplicantController@sDocsStore'
);

//*********************Extra Curricular Activities(R)*********************

Route::any('applicant/extra_curricular/',
    'ApplicantController@extraCurricularIndex'
);

Route::any('applicant/extra_curricular/create',
    'ApplicantController@extraCurricularCreate'
);

Route::any('applicant/extra_curricular_store',
    'ApplicantController@applicantExtraCurricularStore'
);

Route::any('applicant/extra_curricular/show/{id}',[
    'as' => 'extra_curricular.show',
    'uses'=> 'ApplicantController@applicantExtraCurricularShow'
]);

Route::any('applicant/extra_curricular/edit/{id}',
    'ApplicantController@editExtraCurricular'
);

Route::post('applicant/extra_curricular/update/{id}',
    'ApplicantController@updateExtraCurricular'
);

Route::get('applicant/extra-curricular/delete/{id}',
    'ApplicantController@applicantExtraCurricularDelete'
);

//****************Applicant Miscellaneous Info(R)************************

Route::any('applicant/misc_info/',
    'ApplicantController@miscInfoIndex'
);
Route::any('apt/misc_info/create',
    'ApplicantController@miscInfoCreate'
);

Route::any('apt/misc_info/store',
    'ApplicantController@miscInfoStore'
);

Route::any('apt/misc_info/edit/{id}',
    'ApplicantController@miscInfoEdit'
);

Route::any('apt/misc_info/update/{id}',
    'ApplicantController@miscInfoUpdate'
);

//**********************Degree Apply By Applicant ************************************
Route::any('admission/applicant/apply-degree/{degree_id}',
    ['as' => 'admission.applicant.apply-degree',
        'uses' => 'ApplicantController@applyDegreeByApplicant']);

//Admission test details
Route::any('admission/applicant/admission-test-details/{batch_id}',
    ['as' => 'admission.applicant.admission.test_details',
        'uses' => 'ApplicantController@admTestDetails']);
//Exam Center
Route::any('admission/applicant/admission/exm-center/{batch_id}',
    ['as' => 'admission.applicant.exm-center',
        'uses' => 'ApplicantController@admExmCenter']);

Route::any('admission/applicant/admission/save-exm-center',
    ['as' => 'admission.applicant.save-exm-center',
        'uses' => 'ApplicantController@admExmCenterSave']);

//Adm_applicant checkout view
Route::any('admission/applicant/payment-checkout',
    ['as' => 'admission.applicant.adm_checkout',
        'uses' => 'ApplicantController@admPaymentCheckoutByApplicant']);

//**********************Payment option for Applicant ************************************

Route::any('applicant/payment/checkout-bank',[
    'as' => 'applicant.payment.checkout-bank',
    'uses'=> 'ApplicantController@checkoutBank'
]);

Route::any('applicant/payment/checkout/credit-card',[
    'as' => 'applicant.payment.checkout-cc',
    'uses'=> 'ApplicantController@checkoutCC'
]);

Route::any('applicant/degree-apply',[
    'as' => 'applicant.degree-apply',
    'uses'=> 'ApplicantController@admDegreeApply'
]);
//**********************Admission Test for Applicant ************************************

Route::any('applicant/admission-test',[
    'as' => 'applicant.admission-test',
    'uses'=> 'ApplicantController@admission_test'
]);

Route::any('applicant/admission-test-subject/{batch_id}',[
    'as' => 'applicant.admission-test-subject',
    'uses'=> 'ApplicantController@admission_test_subject'
]);

Route::any('applicant/admission-exam-subject/{batch_id}/{admtest_subject_id}',[
    'as' => 'applicant.admission-exam-subject',
    'uses'=> 'ApplicantController@admission_test_subject_exam'
]);

Route::any('applicant/admission/start-admission-test',[
    'as' => 'applicant.admission.start-admission-test',
    'uses'=> 'ApplicantController@start_admission_test'
]);








});