<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*************
* English Language file for Business account
***************************/
/* V1.2.3 */
$lang['transfer_to_personal_no_card'] = 'We have try to send your payment with your wallet balance but is failed, we try with card but is failed because you have not a default card.';
$lang['verification_card_no_number'] = 'Please check card number not correct.';
$lang['error_no_default_card'] = 'Please make active default Visa/Mastercard for payment proccessing if you have no balance.';
$lang['payment_with_card_not_available'] = 'Please check your balance is low, we are try to processing payment with your default card but our network for processing payment with card is not avaible right now.';
$lang['payment_verify_with_card_not_available'] = 'Sorry you can\'t verify your card right now because our card processing gateway is busy.';

/* V1.2.1 */
$lang['wallet_add_local_bank_success'] = 'We can verify your bank account soon, you can receive verification email once we are verify your bank.';
$lang['wallet_bank_pending_warn'] = 'Need to Approval';
$lang['wallet_bank_pending_email_sms_subject'] = 'Verification Bank Pending';
$lang['wallet_bank_pending_email_sms_notes'] = 'We received your BVN. We will notify you of your approval status within 1-3 days. Thank you.';

/* V1.2 */
$lang['verify_card_success_sms_subject'] = 'Your Card is Verified';
$lang['verify_card_success_sms_card_number'] = 'Card number';
$lang['verify_card_code_sms_subject'] = 'We have take fees in your card. Your card verify code is';
$lang['payment_request_sms_subject_hello'] = 'Hello';
$lang['payment_request_sms_subject_you'] = 'You received payment request from';
$lang['payment_sent_sms_subject_hello'] = 'Hello';
$lang['payment_sent_sms_subject_received'] = 'You have received payment in your';
$lang['payment_sent_sms_subject_from'] = 'from';
$lang['payment_refund_sms_subject_hello'] = 'Hello';
$lang['payment_refund_sms_subject_received'] = 'You have received payment in your';
$lang['payment_refund_sms_subject_from'] = 'from';

$lang['verification_meta_title'] = 'Verification Center';
$lang['verification_add_id_card'] = 'ID verification';
$lang['verification_id_card_verified'] = 'ID Verified';
$lang['verification_add_address_location'] = 'Address verification';
$lang['verification_address_verified'] = 'Adress Verified';
$lang['verification_h4_well'] = 'Document verification';
$lang['verification_id_upload_modal_title_h4'] = 'Upload ID Card';
$lang['verification_address_upload_modal_title_h4'] = 'Upload Address document';
$lang['verification_id_upload_form_placeholder_choose_file'] = 'Choose attachment';
$lang['verification_id_upload_form_placeholder_id_select'] = 'ID Type';
$lang['verification_id_upload_form_placeholder_note'] = 'Scan your ID card with showing face and other details in card, upload .pdf, .png, .jpg, .zip';
$lang['verification_address_upload_form_placeholder_note'] = 'Scan your address document, we can accept water billing & bank statement in format of .pdf, .png, .jpg, .zip';
$lang['verification_id_upload_form_submit_button'] = 'Request verfication';
$lang['verification_error_file_type'] = 'Sorry check your attachment file extansion.';
$lang['verification_submit_failed'] = 'Sorry your verification request is refused please try again later.';
$lang['verification_submit_success'] = 'Thank you we received your verification ducument request we can notify you within 1-3 days.';
$lang['verification_submit_address_email_subject'] = 'Address Verification';
$lang['verification_submit_address_sms_subject'] = 'Thank you we received your address verification ducument request we can notify you within 1-3 days.';
$lang['verification_submit_id_email_subject'] = 'ID Verification';
$lang['verification_submit_id_sms_subject'] = 'Thank you we received your ID verification ducument request we will notify you within 1-3 days.';
$lang['verification_error_complete'] = 'Sorry, please submit all documents in order to verify your account.';
$lang['verification_error_complete_link'] = 'Upload document';

$lang['myaccount_meta_title'] = 'Summary';

/**********
*  Header navbar menu */
$lang['navbar_toggle_menu'] = 'Menu';
$lang['navbar_left_summary'] = 'Business';
$lang['navbar_left_activity'] = 'Activity';
$lang['navbar_left_send'] = 'Send & Request Money';
$lang['navbar_left_wallet'] = 'Wallet';
$lang['navbar_left_tools'] = 'Business Tools';
$lang['navbar_left_help'] = 'Help';
$lang['navbar_right_logout'] = 'LOG OUT';


/**********
*  Sidebar panel */
$lang['summary_sidebar_balance'] = 'balance';
$lang['summary_sidebar_details'] = 'Details';
$lang['summary_sidebar_empty_balance'] = 'No payment you have made';
$lang['summary_sidebar_request_fund'] = 'Request Fund';
$lang['summary_sidebar_add_fund'] = 'Add Funds';
$lang['summary_sidebar_withdraw_fund'] = 'Withdraw Funds';
$lang['summary_sidebar_available_balance'] = 'Available balance';
$lang['summary_sidebar_dispute_claim'] = 'Dispute Claim';
$lang['summary_sidebar_dispute_resolve'] = 'Please resolve this in dispute center';
$lang['summary_sidebar_bankcard_title'] = 'Bank accounts and cards';
$lang['summary_sidebar_bankcard_link'] = 'Add bank accounts or card';
$lang['summary_sidebar_bankcard_link_wallet'] = 'Wallet';
$lang['summary_sidebar_bankcard_notes'] = 'Pay more securely with your card.';
$lang['summary_sidebar_bankcard_update_note'] = 'You can update it in your';

/*****
* Right panel */

$lang['summary_right_transaction_h5'] = 'Completed';
$lang['summary_right_pending_h5'] = 'Pending';
$lang['summary_right_no_transaction'] = 'No Transaction you have made';
$lang['summary_right_no_pending_transaction'] = 'No Pending Transaction';
$lang['summary_right_view_all_transaction'] = 'View all';
$lang['summary_right_mostout_avatar_hello'] = 'Hello';
$lang['summary_right_mostout_avatar_button'] = 'Get the most out of ';
$lang['summary_right_mostout_avatar_pay_goods'] = 'Pay for goods or services';
$lang['summary_right_mostout_avatar_check_report'] = 'Payment Report';
$lang['summary_right_mostout_avatar_money'] = 'Send Money';
$lang['summary_right_mostout_avatar_mobile_app'] = 'Get Business App';
$lang['summary_right_mostout_hidden_down_h1'] = 'Power up more ways to use ';
$lang['summary_right_mostout_hidden_p_account'] = 'Account created';
$lang['summary_right_mostout_hidden_p_email'] = 'Email address confirmed';
$lang['summary_right_mostout_hidden_p_card'] = 'Link card';
$lang['summary_right_mostout_hidden_p_card_linked'] = 'Card Linked';

/**********
*  Wallet */

$lang['wallet_meta_title'] = 'Wallet';
$lang['wallet_bank_h4'] = 'Bank accounts';
$lang['wallet_bank_text_account'] = 'Link a bank account';
$lang['wallet_nigeria_bank_text_account'] = 'Nigeria Bank Account';
$lang['wallet_card_h4'] = 'Credit Cards';
$lang['wallet_card_text_account'] = 'Link a card';
$lang['wallet_nigeria_card_text_account'] = 'Nigeria Bank Card';
$lang['wallet_card_text_button_verify'] = 'Verify card';
$lang['wallet_add_card_name'] = 'Card Holder Name';
$lang['wallet_add_card_number'] = 'Card Number';
$lang['wallet_add_card_exp_month'] = 'Exp month';
$lang['wallet_add_card_exp_year'] = 'Exp year';
$lang['wallet_add_card_cvc'] = 'CVC';
$lang['wallet_add_card_form_note_side_one'] = 'NOTE: We can take';
$lang['wallet_add_card_form_note_side_two'] = 'to verify your card';
$lang['wallet_add_card_form_card_type_select'] = 'Card type';
$lang['wallet_add_card_form_card_number_placeholder'] = 'Card number';
$lang['wallet_add_card_form_card_month_placeholder'] = 'Month';
$lang['wallet_add_card_form_card_year_placeholder'] = 'Year';
$lang['wallet_add_card_form_card_cvc_placeholder'] = 'CVC (3 digits)';
$lang['wallet_add_card_form_card_submit_button'] = 'Save';

$lang['wallet_add_card_failed'] = 'Card is failed to add Please try again later';
$lang['wallet_add_card_success_alert'] = 'Card is success Added';

$lang['wallet_add_bank_bank_ac_name'] = 'Account Name';
$lang['wallet_add_bank_number'] = 'Account Number';
$lang['wallet_add_bank_swift_code'] = 'SWIFT Code';
$lang['wallet_add_bank_bankname'] = 'Bank Name';
$lang['wallet_add_bank_branch_name'] = 'Branch Name';
$lang['wallet_add_bank_country'] = 'Bank Country';
$lang['wallet_add_bank_city'] = 'Bank City';
$lang['wallet_add_bank_form_note'] = 'NOTE: Please fill correct information to get faster to receive your fund after withdraw to your bank account.';
$lang['wallet_add_nigeria_bank_form_note'] = 'NOTE: Please fill correct information to get faster to receive your fund after withdraw to your Bank Card.';
$lang['wallet_add_bank_form_placeholder_account_name'] = 'Account name';
$lang['wallet_add_bank_form_placeholder_account_number'] = 'Account number';
$lang['wallet_add_bank_form_placeholder_swift'] = 'Bank swift code';
$lang['wallet_add_bank_form_placeholder_bank_name'] = 'Bank name';
$lang['wallet_add_bank_form_placeholder_birthday'] = 'Birthday date';
$lang['wallet_add_bank_form_placeholder_bvn'] = '11 digits';
$lang['wallet_add_bank_form_placeholder_bank_branch'] = 'Branch name';
$lang['wallet_add_bank_form_placeholder_bank_city'] = 'Bank city';
$lang['wallet_add_bank_form_submit_button'] = 'Agree and Add';

$lang['wallet_add_bank_failed'] = 'Bank Account is failed to add Please try again later';
$lang['wallet_add_bank_success'] = 'Your Bank Account is added.';


$lang['wallet_card_add_check_card_exist_form'] = 'Card number';
$lang['check_card_exist_validate'] = 'Sorry your card is aready used, please add other card';
$lang['check_card_exist_validate_empty'] = 'Sorry add valid card number';

$lang['check_bank_exist_validate'] = 'Sorry your Bank is aready used, please add other card';
$lang['check_bank_exist_validate_empty'] = 'Sorry add valid Bank number';

$lang['wallet_verify_form_code'] = 'Code';
$lang['verify_card_code_validate_empty'] = 'Please add code';
$lang['verify_card_code_validate_error'] = 'Sorry your Verify code is incorrect';
$lang['verify_card_code_email_subject'] = 'Card Verify Code';
$lang['verify_card_success_email_subject'] = 'Card Verified';


$lang['wallet_verify_card_code_failed'] = 'Sorry your card are not verify try again later, or contact Us';
$lang['wallet_verify_card_code_success'] = 'Your card is successs to verified';
$lang['wallet_card_add_failed'] = 'Sorry card failed to verify or your card has no balance, please try again later';
$lang['wallet_card_add_success'] = 'Your card is success to add please check your inbox email or spam folder to see Verification code to verify your card, if you don\'t see please contact Us';

$lang['wallet_local_card_add_failed'] = 'Sorry card failed to add, please try again later.';
$lang['wallet_local_card_add_success'] = 'Your card is success to add.';

$lang['wallet_add_deafult_card_failed'] = 'Sorry card failed to make default, please try again later.';
$lang['wallet_add_deafult_card_success'] = 'Your card is success to be default.';

$lang['wallet_remove_card_failed'] = 'Sorry card failed to remove try again later';
$lang['wallet_remove_card_success'] = 'Your card is successfully removed.';

$lang['wallet_remove_bank_failed'] = 'Sorry Bank failed to remove try again later';
$lang['wallet_remove_bank_success'] = 'Your Bank is success to remove.';


$lang['activity_meta_title_activity'] = 'Activity';
$lang['activity_head_h5_completed'] = 'Completed';
$lang['activity_form_serach_bar_placeholder'] = 'Search activities (Email or Transaction ID)';

/* Payment send
***********/

$lang['transfer_meta_title'] = 'Send & Request Money';
$lang['transfer_box_lock_text_top_covered'] = 'Covered by ';
$lang['transfer_box_lock_text_top_covered_link'] = 'Buyer & Seller protection.';
$lang['transfer_box_lock_text_top_covered_down'] = 'The receiver of the payment pay a fees';
$lang['transfer_box_link_pay'] = 'Pay for goods or Services';
$lang['transfer_box_link_invoice'] = 'Create invoice';
$lang['transfer_box_request'] = 'Request from friends or customers';
$lang['transfer_box_request_notice'] = 'You may be eligible for ';
$lang['transfer_box_request_notice_link'] = 'Saller Protection';
$lang['transfer_box_request_notice_2'] = 'if you\'re selling goods or services.';


$lang['transfer_send_meta_title'] = 'Send Payment';
$lang['transfer_send_h4'] = ' Pay for goods or services';
$lang['transfer_send_p'] = ' Currency converesion fees may apply. Your eligible purchases or send payment can covered by our';
$lang['transfer_send_p_link'] = ' Buyer protection';
$lang['transfer_form_email_placeholder'] = 'Email Address or Mobile';
$lang['transfer_form_next_button'] = 'Next';

$lang['transfer_send_form_sennding_to'] = 'You\'re sending to';
$lang['transfer_send_form_your_sennding'] = 'Your sending';
$lang['transfer_send_form_recepient_receive'] = 'Recepient receives';
$lang['transfer_send_form_exchange_rate_note'] = 'Exchange rate: 1 USD = 1.0000 USD';
$lang['transfer_send_form_exchange_rate_down'] = 'This rate includes our currency conversion fees.';
$lang['transfer_send_form_placeholder_textarea'] = 'Add a note';
$lang['transfer_send_form_transfer_process'] = 'Pay with balance if no balance we can take in your default Credit/Debit card';
$lang['transfer_send_form_for_more_info'] = 'For more information please ready our';
$lang['transfer_send_form_for_more_info_link'] = 'User Agreement';
$lang['transfer_send_form_button_send'] = 'Send Money';
$lang['transfer_send_form_button_cancel'] = 'Cancel';


$lang['transfer_send_complete_meta_title'] = 'Complete Purchases';
$lang['receipt_not_get_payment'] = 'Sorry your Receipt are not received payment try to send to ther Receipt';
$lang['send_payment_email_validate_empty_value'] = 'Sorry filed is empty please add receipt email';
$lang['send_payment_email_validate_no_email_mobile'] = 'Sorry your Receipt is invalid or not in our system';
$lang['send_payment_email_validate_yourself'] = 'Sorry your can\'t send payment to Yourself';
$lang['send_payment_send_form_recepient_validate'] = 'Recepient';
$lang['send_payment_complete_form_amount_validate'] = 'Amount';
$lang['send_payment_complete_form_note_validate'] = 'Note';
$lang['send_payment_complete_error_validate_fees_check'] = 'Decreise your sending amount or add fund to send more than {field} you request for sending.';

$lang['balance_payment_failed'] = 'Sorry Payment is failed to sent please try again later or add more fund.';
$lang['balance_payment_complete_sent'] = 'Payment is sent success.';
$lang['Payment_made_subject'] = 'Payment Received';
$lang['payment_send_card_success'] = 'Payment is sent success. We\'re taken our fees in your card, Thank you.';
$lang['payment_send_card_failed'] = 'Payment is failed or you have not payment in your card.';

$lang['transfer_success_meta_title'] = 'Payment Done';
$lang['transfer_success_requested'] = 'You\'ve request ';
$lang['transfer_success_requested_to'] = 'to';
$lang['transfer_success_sent'] = 'You\'ve sent ';
$lang['transfer_success_card_sent_info'] = 'This payment is made from your card';
$lang['transfer_success_refund_sent'] = 'You\'ve refund ';
$lang['transfer_success_sent_to'] = 'to';
$lang['transfer_success_another_transfer'] = 'Make another payment';
$lang['transfer_success_another_request'] = 'Make another request';
$lang['transfer_success_go_back'] = 'Go to Summary';

/* Payment request
***********/

$lang['transfer_request_payment_meta_title'] = 'Request Payment';
$lang['transfer_request_notice'] = 'Request Payment';
$lang['transfer_request_payment_form_send_amount'] = 'Your request';
$lang['transfer_request_payment_form_placeholder_amount'] = 'Amount';
$lang['transfer_request_payment_form_receiver_request'] = 'To Friend Email';
$lang['transfer_request_payment_form_placeholder_receiver_request'] = 'Email address';
$lang['transfer_request_payment_form_placeholder_add_note'] = 'Add a note (optional)';
$lang['transfer_request_payment_form_button_request'] = 'Request a Payment';
$lang['transfer_request_payment_form_button_request_cancel'] = 'Cancel';

$lang['transfer_request_form_amount_validate'] = 'Amount';
$lang['transfer_request_form_receipt_validate'] = 'Email address';
$lang['transfer_request_form_receipt_validate'] = 'Add a note';
$lang['request_payment_email_validate_empty_value'] = 'Sorry please fill all field, to send your request';
$lang['request_payment_email_validate_no_email_mobile'] = 'Sorry your receipt are not in our system or is deleted, try another';
$lang['request_payment_email_validate_yourself'] = 'Sorry you can\'t request payment to yourself';
$lang['payment_request_failed'] = 'Your Request for payment is failed, Please try again later';
$lang['payment_request_success'] = 'Your request of payment are sending to Receipt, Thank you.';
$lang['payment_request_failed'] = 'Your request is failed to send, try again later.';
$lang['payment_request_subject'] = 'Payment Request';
$lang['cancel_requestmoney_failed'] = 'Sorry your cancel request is failed to cancel try gain later.';
$lang['cancel_requestmoney_success'] = 'You have success to cancel request payment';

$lang['refund_form_amount_validate'] = 'Amount';
$lang['refund_form_receiver_validate'] = 'Receiver';
$lang['refund_form_transaction_id_validate'] = 'Transaction ID';

/* Settings
***********/

$lang['settings_account_profile_well_h4'] = 'Profile';
$lang['settings_account_profile_upload_link'] = 'Update Photo';
$lang['settings_account_profile_joined'] = 'Joined in';
$lang['settings_account_meta_title'] = 'Account settings';
$lang['settings_account_modal_title_h3'] = 'Fix a minor typo';
$lang['settings_account_modal_current_name'] = 'Current name:';
$lang['settings_account_modal_legal_name'] = 'Legal name';
$lang['settings_account_form_first_name_placeholder'] = 'First name';
$lang['settings_account_form_last_name_placeholder'] = 'Last name';
$lang['settings_account_form_business_name_placeholder'] = 'Business name';
$lang['settings_account_form_first_name_validate'] = 'First name';
$lang['settings_account_form_last_name_validate'] = 'Last name';
$lang['settings_account_form_business_name_validate'] = 'Business name';
$lang['settings_account_form_card_update_button'] = 'Update Name';
$lang['account_update_success'] = 'Your business info have been changing, Thank you.';
$lang['account_update_failed'] = 'Sorry your business info failed to update, please try again later.';
$lang['account_update_form_empty_failed'] = 'Sorry check your input value are not correct or is empty, (All input form are required)';

$lang['settings_account_upload_modal_title_h3'] = 'Business Logo';
$lang['settings_account_upload_modal_form_choose'] = 'Choose File';
$lang['settings_account_upload_modal_form_choose_note'] = 'A photo larger than 256 pixels are looking good. Most photos taken with a smartphone are the right size.';
$lang['settings_account_form_upload_button'] = 'Add your Logo';

$lang['settings_account_update_idcard_modal_title_h3'] = 'National ID';
$lang['settings_account_update_idcard_type_form_number_placeholder'] = 'National card type';
$lang['settings_account_update_idcard_form_number_placeholder'] = 'Enter your ID';
$lang['settings_account_update_idcard_type_form_number_validate'] = 'National card type';
$lang['settings_account_update_idcard_form_number_validate'] = 'ID number';
$lang['settings_account__idcard_form_update_button'] = 'Save';

$lang['settings_account__options_well_h4'] = 'Account options';
$lang['settings_account__options_ul_li_nationality'] = 'Nationality';
$lang['settings_account__options_ul_li_merchant_id'] = 'Merchant ID';
$lang['settings_account__options_ul_li_national_id'] = 'National ID';

$lang['settings_account_update_address_well_header_h4'] = 'Business Address';
$lang['settings_account_update_address_well_p_default'] = 'Primary, Billing address';
$lang['settings_account_update_address_well_edit_link'] = 'Edit';
$lang['settings_account_update_address_modal_title_h3'] = 'Edit Business Address';
$lang['settings_account_update_address_form_address1_placeholder'] = 'Address line 1';
$lang['settings_account_update_address_form_address2_placeholder'] = 'Address line 2';
$lang['settings_account_update_address_form_city_placeholder'] = 'City / Town / Village';
$lang['settings_account_update_address_form_state_placeholder'] = 'State / Province / Region';
$lang['settings_account_update_address_form_postal_code_placeholder'] = 'Postal code';
$lang['settings_account_update_address_form_address1_validate'] = 'Address line 1';
$lang['settings_account_update_address_form_address2_validate'] = 'Address line 2';
$lang['settings_account_update_address_form_city_validate'] = 'City / Town / Village';
$lang['settings_account_update_address_form_state_validate'] = 'State / Province / Region';
$lang['settings_account_update_address_form_postal_code_validate'] = 'Postal code';
$lang['settings_account_address_form_update_button'] = 'Change address';

$lang['settings_account_update_email_well_header_h4'] = 'Email address';
$lang['settings_account_update_email_well_p_default'] = 'Primary email';

$lang['settings_account_update_phone_well_header_h4'] = 'Business Phone';
$lang['settings_account_update_phone_well_p_default'] = 'Mobile, Primary';

$lang['settings_account_update_phone_modal_title_h3'] = 'Edit a Mobile number';
$lang['settings_account_update_phone_form_mobile_placeholder'] = 'Enter mobile number';


$lang['settings_security_meta_title'] = 'Security settings';
$lang['settings_security_well_header_h4_password'] = 'Password';
$lang['settings_security_update_password_p'] = 'Create or update your Password.';
$lang['settings_security_well_header_h4_pin'] = 'Customer service PIN';
$lang['settings_security_update_password_modal_title_h3'] = 'Change your password';
$lang['settings_security_p_form_confirm_password'] = 'Confirm your current password';
$lang['settings_security_update_form_current_password_placeholder'] = 'Current Password';
$lang['settings_security_p_form_new_password'] = 'Enter your new password';
$lang['settings_security_update_form_new_password_placeholder'] = 'New Password';
$lang['settings_security_update_form_confirm_password_placeholder'] = 'Confirm Password';
$lang['settings_security_password_form_update_button'] = 'Change password';
$lang['security_update_success'] = 'Your security info have been changing, Thank you.';
$lang['security_update_failed'] = 'Sorry your security info failed to update, please try again later.';
$lang['security_update_form_empty_failed'] = 'Sorry check your input value are not correct or is empty, (All input form are required)';
$lang['settings_security_update_form_current_password_validate'] = 'Current Password';
$lang['settings_security_update_form_new_password_validate'] = 'New Password';
$lang['settings_security_update_form_confirm_password_validate'] = 'Confirm Password';
$lang['settings_security_update_form_password_strong_validate'] = 'Password must be contain number, lower, uppercase letters and characters eg. $, %, ^, #,@.. etc.';
$lang['settings_security_update_form_password_validate_callback'] = 'Sorry your current password are not correct';

$lang['settings_security_update_in_modal_title_h3'] = 'Add or change your</br>customer service PIN';
$lang['settings_security_update_form_pin_placeholder'] = 'New customer service PIN (6 numbers)';
$lang['settings_security_update_form_confirm_pin_placeholder'] = 'Confirm new customer service PIN';
$lang['settings_security_update_form_pin_validate'] = 'Customer service PIN';
$lang['settings_security_update_form_confirm_pin_validate'] = 'Confirm customer service PIN';
$lang['settings_security_pin_form_update_button'] = 'Add or change PIN';

$lang['settings_payments_meta_title'] = 'Payments settings';
$lang['settings_payments_instore_h4_head'] = 'Your preferred way to pay';
$lang['settings_payments_instore_p_when_head'] = 'When it\'s time to pay, you\'ve got options. Check out your preferences below.';
$lang['settings_payments_instore_h5_expand'] = 'In-store purchases';
$lang['settings_payments_instore_h5_expand_link'] = 'Choose';
$lang['settings_payments_instore_h5_expand_pay_notes'] = 'Pay with balance first then if no balance take payment in default Card.';

$lang['settings_notifications_meta_title'] = 'Notification settings';
$lang['settings_payments_notifications_notes'] = 'All notification about payment you can receive as posible.';