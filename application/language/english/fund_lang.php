<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*************
* English Language file for Fund
***************************/
/* V1.2.3 */
$lang['fund_deposit_card_wait_processing'] = 'Payment is processing, Please wait...';
$lang['fund_deposit_card_ajax_success'] = 'Payment is success to Deposit';
$lang['fund_deposit_card_ajax_failed'] = 'Payment is failed try again later';
$lang['fund_deposit_card_ajax_no_card'] = 'Sorry you did not have active card, Please add card.';
$lang['fund_deposit_card_ajax_no_card_select'] = 'Select card';
$lang['fund_payment_with_card_not_available'] = 'Sorry Payment with card is not availabe right now, Please try again later.';
$lang['Deposit_sms_subject_hello'] = 'Hello!';
$lang['Deposit_sms_subject_have'] = 'You have Deposit';
$lang['Deposit_sms_subject_to_wallet'] = 'to your wallet, Login here https://yoursite.com to see your balance.';
$lang['Deposit_sms_subject_to_wallet_a'] = 'to your Wallet, ';
$lang['Deposit_sms_subject_with_method'] = 'With';
$lang['Deposit_sms_subject_link_go'] = 'Login here https://yoursite.com to see your Balance.';
$lang['not_login'] = 'Sorry please login';

$lang['fund_meta_title'] = 'Deposit funds';
$lang['fund_deposit_well_header_h5'] = 'Deposit Method';
$lang['fund_deposit_fess_notice'] = 'Processing fees';
$lang['fund_deposit_head_bank_and_card'] = 'Bank and Card';
$lang['fund_deposit_head_mobile_money'] = 'Mobile Money';
$lang['fund_deposit_head_other'] = 'Other';

$lang['fund_deposit_failed'] = 'Sorry we can not processing your payment right now please try later.';
$lang['fund_deposit_success'] = 'Thank you your fund is processing.';
$lang['fund_bank_deposit_success'] = 'Thank you we receive your fund request we can accept as soon we receive your payment in our bank account.';
$lang['fund_western_deposit_success'] = 'Thank you we receive your fund request we can accept as soon you send MTCN to our email.';
$lang['fund_mobile_deposit_success'] = 'Thank you we receive your fund request we can accept as soon we receive your payment, remember to send to our Paybill with Reference number.';
$lang['fund_other_deposit_success'] = 'Thank you your fund is success Processed';
$lang['fund_other_deposit_cancel'] = 'Sorry payment was cancel';

/* Deposit by Card & Bank 
********/
$lang['fund_deposit_card_well_header_h5'] = 'Deposit - Credit/Debit Card';
$lang['fund_add_card_form_amount_validate'] = 'Amount';
$lang['fund_add_card_form_label_need'] = 'How much you need';
$lang['fund_add_card_form_label_add_fund'] = 'Add fund with card';
$lang['fund_add_nigeria_form_label_add_fund'] = 'Select Bank Acoount';
$lang['fund_add_card_form_submit_button'] = 'Deposit Fund';


$lang['fund_deposit_bank_well_header_h5'] = 'Deposit - Bank';
$lang['fund_add_bank_form_amount_validate'] = 'Amount';
$lang['fund_add_bank_form_label_need'] = 'How much you need';
$lang['fund_add_bank_form_label_add_fund'] = 'Send payment to our Bank account';
$lang['fund_add_western_form_label_add_fund'] = 'Send payment to Western Union details';
$lang['fund_add_western_form_label_p_note'] = 'NOTE: After send your pament please send screenshot and MTCN PIN to';
$lang['fund_add_bank_form_submit_button'] = 'Deposit Fund';

/* Deposit by Mobile & Other
********/
$lang['fund_deposit_mpesa_well_header_h5'] = 'Deposit - M-PESA';
$lang['fund_deposit_tigopesa_well_header_h5'] = 'Deposit - TIGO-PESA';
$lang['fund_deposit_mtn_well_header_h5'] = 'Deposit - MTN';
$lang['fund_deposit_orange_well_header_h5'] = 'Deposit - ORANGE';
$lang['fund_deposit_bitcoin_well_header_h5'] = 'Deposit - BITCOIN';
$lang['fund_deposit_paypal_well_header_h5'] = 'Deposit - PAYPAL';
$lang['fund_deposit_western_well_header_h5'] = 'Deposit - WESTERN UNION';
$lang['fund_add_amount_form_label_need'] = 'How much you need';
$lang['fund_add_send_form_label_info'] = 'Send payment to our';
$lang['fund_add_form_label_paybill'] = 'Paybill:';
$lang['fund_add_form_label_reference'] = 'Reference:';
$lang['fund_add_form_label_reference_p_note'] = 'Remeber to Enter your reference number';
$lang['fund_add_amount_form_amount_validate'] = 'Amount';
$lang['fund_add_mobile_form_submit_button'] = 'Deposit Fund';


/* Withdraw 
********/
$lang['withdraw_meta_title'] = 'Withdraw funds';
$lang['fund_withdraw_fess_notice'] = 'Processing fees';
$lang['fund_withdraw_well_header_h5'] = 'Withdraw Method';
$lang['fund_withdraw_mpesa_well_header_h5'] = 'Withdraw - M-PESA';
$lang['fund_withdraw_tigopesa_well_header_h5'] = 'Withdraw - TIGO-PESA';
$lang['fund_withdraw_mtn_well_header_h5'] = 'Withdraw - MTN';
$lang['fund_withdraw_orange_well_header_h5'] = 'Withdraw - ORANGE';
$lang['fund_withdraw_bitcoin_well_header_h5'] = 'Withdraw - BITCOIN';
$lang['fund_withdraw_paypal_well_header_h5'] = 'Withdraw - PAYPAL';
$lang['fund_withdraw_western_well_header_h5'] = 'Withdraw - WESTERN UNION';
$lang['fund_withdraw_moneygram_well_header_h5'] = 'Withdraw - MoneyGram';
$lang['fund_withdraw_perfectMoney_well_header_h5'] = 'Withdraw - PerfectMoney';
$lang['fund_withdraw_neteller_well_header_h5'] = 'Withdraw - NETELLER';
$lang['fund_withdraw_skrill_well_header_h5'] = 'Withdraw - SKRILL';
$lang['fund_withdraw_payza_well_header_h5'] = 'Withdraw - PAYZA';
$lang['fund_withdraw_payu_well_header_h5'] = 'Withdraw - PAYU';
$lang['fund_add_amount_form_label_need'] = 'How much you need';
$lang['fund_withdraw_card_well_header_h5'] = 'Withdraw - Visa/Mastercard';
$lang['fund_withdraw_bank_well_header_h5'] = 'Withdraw - Bank Transfer';
$lang['fund_withdraw_failed'] = 'Sorry we can not processing your payment right now please try later.';
$lang['fund_withdraw_success'] = 'Thank you we receive your request we can processing within 1-2 hours.';
$lang['fund_withdraw_card_success'] = 'Thank you we receive your request, you fund it take 3-7 business days to appear on your card statement.';
$lang['fund_withdraw_bank_success'] = 'Thank you we receive your request, you fund it take 2-5 business days to appear on your bank statement.';
$lang['fund_withdraw_balance_zero'] = 'Sorry you do not have enough money, to processing your request, please add more money.';
$lang['fund_withdraw_western_success'] = 'Thank you we receive your request we can processing within 1-2 hours, and you can receive MTCN PIN in your mobile sms.';
$lang['fund_withdraw_moneygram_success'] = 'Thank you we receive your request we can processing within 1-2 hours, and you can receive MTCN PIN in your mobile sms.';
$lang['fund_withdraw_form_label_mpesa'] = 'M-PESA';
$lang['fund_withdraw_form_label_tigopesa'] = 'TIGO-PESA';
$lang['fund_withdraw_form_label_mtn'] = 'MTN';
$lang['fund_withdraw_form_label_orange'] = 'ORANGE';
$lang['fund_withdraw_form_label_bitcoin'] = 'BITCOIN';
$lang['fund_withdraw_form_label_paypal'] = 'PAYPAL';
$lang['fund_withdraw_form_label_western'] = 'WESTERN UNION';
$lang['fund_withdraw_form_label_moneygram'] = 'MoneyGram';
$lang['fund_withdraw_form_label_perfectmoney'] = 'PerfectMoney';
$lang['fund_withdraw_form_label_neteller'] = 'NETELLER';
$lang['fund_withdraw_form_label_skrill'] = 'SKRILL';
$lang['fund_withdraw_form_label_payza'] = 'PAYZA';
$lang['fund_withdraw_form_label_payu'] = 'PAYU INDIA';
$lang['fund_withdraw_card_form_label_add_fund'] = 'Transfer fund to Card';
$lang['fund_withdraw_bank_form_label_add_fund'] = 'Transfer fund to Bank Account';
$lang['fund_withdraw_card_form_label_number'] = 'Card';
$lang['fund_withdraw__other_form_submit_button'] = 'Transfer Fund';
$lang['fund_withdraw_amount_form_amount_validate'] = 'Amount';
$lang['fund_withdraw_mobile_form_amount_validate'] = 'Mobile Number eg. +255xxxxxx';
$lang['fund_withdraw_mobile_form_amount__req_validate'] = 'Mobile Number';
$lang['fund_withdraw_btc_form_address_validate'] = 'Bitcoin Address';
$lang['fund_withdraw_paypal_form_email_validate'] = 'Paypal Email';
$lang['fund_withdraw_perfectmoney_form_address_validate'] = 'PerfectMoney address';
$lang['fund_withdraw_neteller_form_email_validate'] = 'Neteller Email';
$lang['fund_withdraw_skrill_form_email_validate'] = 'Skrill Email';
$lang['fund_withdraw_payza_form_email_validate'] = 'Payza Email';
$lang['fund_withdraw_payu_form_address_validate'] = 'PayU address';
$lang['fund_withdraw_form_label_info'] = 'Withdraw fund with';
$lang['fund_withdraw__mobile_form_submit_button'] = 'Transfer Fund';
$lang['fund_withdraw_bank_form_account_validate'] = 'Bank Select';
$lang['fund_withdraw_card_form_select_validate'] = 'Card Select';
$lang['fund_withdraw_western_form_name_validate'] = 'Name';
$lang['fund_withdraw_western_form_city_validate'] = 'City';
$lang['fund_withdraw_western_form_country_validate'] = 'Country';
$lang['fund_withdraw_western_form_phone_validate'] = 'Phone';
$lang['fund_withdraw_moneygram_form_name_validate'] = 'Name';
$lang['fund_withdraw_moneygram_form_city_validate'] = 'City';
$lang['fund_withdraw_moneygram_form_country_validate'] = 'Country';
$lang['fund_withdraw_moneygram_form_phone_validate'] = 'Phone';
