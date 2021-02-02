(function($){$(document).ready(function(){$('body').on('click','.mepr-signup-form .have-coupon-link',function(e){e.preventDefault();$(this).hide();$('div.mepr_coupon_'+$(this).data("prdid")).show();});$('.mepr_price_cell').each(function(){$(this).data('default-price-string',$(this).text());});var meprValidateInput=function(obj,submitting){$(obj).removeClass('invalid');var form=$(obj).closest('.mepr-signup-form');if($(obj).attr('required')!==undefined){var notBlank=true;if($(obj).is('input')||$(obj).is('select')||$(obj).is('textarea')){notBlank=mpValidateNotBlank($(obj).val());}
else if($(obj).hasClass('mepr-checkbox-field')){notBlank=$(obj).find('input').is(':checked');}
else if($(obj).hasClass('mepr-radios-field')||$(obj).hasClass('mepr-checkboxes-field')){var input_vals=[];$.each($(obj).find('input'),function(i,obj){if($(obj).is(':checked')){input_vals.push(true);}});notBlank=mpValidateNotBlank(input_vals);}
mpToggleFieldValidation($(obj),notBlank);}
if($(obj).attr('type')==='email'&&$(obj).val().length>0){var validEmail=mpValidateEmail($(obj).val());mpToggleFieldValidation($(obj),validEmail);}
if($(obj).attr('type')==='url'&&$(obj).val().length>0){var validURL=$(obj).is(':valid');mpToggleFieldValidation($(obj),validURL);}
if($(obj).hasClass('mepr-password-confirm')){var confirmMatch=$(obj).val()===form.find('.mepr-password').val();mpToggleFieldValidation($(obj),confirmMatch);}
if($(obj).hasClass('mepr-coupon-code')&&!submitting){var price_string=form.find('div.mepr_price_cell');if($(obj).val().match(/(\s|\S)/)){$(obj).prev('.mp-form-label').find('.mepr-coupon-loader').fadeIn();var data={action:'mepr_validate_coupon',code:$(obj).val(),prd_id:$(obj).data("prdid"),coupon_nonce:MeprSignup.coupon_nonce};$.post(MeprI18n.ajaxurl,data,function(res){$(obj).prev('.mp-form-label').find('.mepr-coupon-loader').hide();res=res.trim();mpToggleFieldValidation($(obj),(res.toString()=='true'));if(res.toString()=='true'){meprUpdatePriceTerms(form);}
else{form.find('.mepr-payment-methods-wrapper:hidden').show();form.find('input[name="mepr_payment_methods_hidden"]').remove();price_string.text(price_string.data('default-price-string'));meprUpdatePriceTerms(form);}});}
else if($(obj).val().trim()===''){if(form.find('.mepr-payment-methods-wrapper').is(':hidden')){form.find('.mepr-payment-methods-wrapper').show();form.find('input[name="mepr_payment_methods_hidden"]').remove();}
price_string.text(price_string.data('default-price-string'));meprUpdatePriceTerms(form);}}
$(obj).trigger('mepr-validate-input');};var meprUpdatePriceTerms=function(form,submitting){var price_string=form.find('div.mepr_price_cell');let settings={url:MeprI18n.ajaxurl,type:'POST',dataType:'json',data:{code:form.find('input[name="mepr_coupon_code"]').val(),prd_id:form.find('input[name="mepr_product_id"]').val(),mepr_address_one:form.find('input[name="mepr-address-one"]').val(),mepr_address_two:form.find('input[name="mepr-address-two"]').val(),mepr_address_city:form.find('input[name="mepr-address-city"]').val(),mepr_address_state:form.find('select[name="mepr-address-state"]').is(':visible')?form.find('select[name="mepr-address-state"]').val():form.find('input[name="mepr-address-state"]').val(),mepr_address_country:form.find('select[name="mepr-address-country"]').val(),mepr_address_zip:form.find('input[name="mepr-address-zip"]').val(),mepr_vat_number:form.find('input[name="mepr_vat_number"]').val(),mepr_vat_customer_type:form.find('input[name="mepr_vat_customer_type"]:checked').val(),coupon_nonce:MeprSignup.coupon_nonce}}
settings.data.action='mepr_update_price_string';$.ajax(settings).done(function(response){if(response&&typeof response=='object'&&response.status==='success'){if(price_string.length){var scroll_top=price_string.offset().top;price_string.html(response.price_string).parent().css({opacity:0});if(MeprSignup.spc_invoice=='1'){price_string.parent().animate({opacity:1},1000);}else{$('html, body').animate({scrollTop:scroll_top-30},200,function(){price_string.parent().animate({opacity:1},1000);});}}
if(response.payment_required){form.find('.mepr-payment-methods-wrapper').show();form.find('input[name="mepr_payment_methods_hidden"]').remove();}else{form.find('.mepr-payment-methods-wrapper').hide();form.append('<input type="hidden" name="mepr_payment_methods_hidden" value="1">');}}});settings.data.action='mepr_update_spc_invoice_table';$.ajax(settings).done(function(response){if(response&&typeof response=='object'&&response.status==='success'){$(form).find('.mepr-transaction-invoice-wrapper > div').replaceWith(response.invoice);}
$(form).find('.mepr-invoice-loader').hide();$(form).find(".mepr-transaction-invoice-wrapper .mp_invoice").css({opacity:1});});}
$('body').on('focus','.mepr-form .mepr-form-input',function(e){$(this).prev('.mp-form-label').find('.cc-error').hide();$(this).removeClass('invalid');});$('body').on('blur','.mepr-form .mepr-form-input',function(e){if(!$(this).hasClass('mepr-date-picker')){meprValidateInput(this);}});$('body').on('mepr-date-picker-closed','.mepr-form .mepr-form-input.mepr-date-picker',function(e,date,inst){meprValidateInput(this);});$('body').on('click','.mepr-signup-form .mepr-submit',function(e){e.preventDefault();var form=$(this).closest('.mepr-signup-form');var button=$(this);$.each(form.find('.mepr-form-input:visible'),function(i,obj){meprValidateInput(obj,true);});if(0<form.find('.invalid:visible').length){form.find('.validation').addClass('failed');}
else{var submittedTelInputs=document.querySelectorAll(".mepr-tel-input");for(var i=0;i<submittedTelInputs.length;i++){var iti=window.intlTelInputGlobals.getInstance(submittedTelInputs[i]);submittedTelInputs[i].value=iti.getNumber();}
form.find('.validation').addClass('passed');this.disabled=true;form.find('.mepr-loading-gif').show();$(this).trigger('mepr-register-submit');form.submit();}});$('body').on('click','.mepr-signup-form div[class^=mepr-payment-method] input.mepr-form-radio',function(){var form=$(this).closest('.mepr-signup-form');form.find('input[name="mepr_transaction_id"]').val('');var pmid='.mp-pm-desc-'+$(this).val();var pmid_exists=(form.find(pmid).length>0);form.find('.mepr-payment-method-desc-text').addClass('mepr-close');if(pmid_exists){form.find(pmid).removeClass('mepr-close');}
var mepr_close_exists=(form.find('.mepr-payment-method-desc-text.mepr-close').length>0);if(mepr_close_exists){form.find('.mepr-payment-method-desc-text.mepr-close').slideUp({duration:200,complete:function(){if(pmid_exists){form.find(pmid).slideDown(200);}}});}else{if(pmid_exists){form.find(pmid).slideDown(200);}}});$("body").on("change",".mepr-form .mepr-form-input, .mepr-form .mepr-form-radios-input, .mepr-form .mepr-select-field",function(e){if($(this).attr('name')=='mepr-address-zip'||$(this).attr('name')=='mepr-address-city'||$(this).attr('name')=='mepr-address-country'||$(this).attr('name')=='mepr_vat_customer_type'||$(this).attr('name')=='mepr_vat_number'){let form=$(this).closest(".mepr-signup-form");meprUpdatePriceTerms(form);}});});})(jQuery);