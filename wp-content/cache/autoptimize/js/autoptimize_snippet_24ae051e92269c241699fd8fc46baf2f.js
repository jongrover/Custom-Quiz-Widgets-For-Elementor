jQuery(document).ready(function($){var currentYear=new Date().getFullYear();var pastYears=currentYear-100;var futureYears=currentYear+50;var dateFormat='yy-mm-dd';var timeFormat='HH:mm:ss';var showTime=true;if(typeof MeprDatePicker!="undefined"){if(MeprDatePicker.hasOwnProperty('dateFormat')){dateFormat=String(MeprDatePicker.dateFormat);}
timeFormat=MeprDatePicker.timeFormat;showTime=Boolean(MeprDatePicker.showTime);}
$('.mepr-date-picker').datetimepicker({dateFormat:dateFormat,timeFormat:timeFormat,yearRange:pastYears+":"+futureYears,changeMonth:true,changeYear:true,showTime:showTime,onSelect:function(date,inst){$(this).trigger('mepr-date-picker-selected',[date,inst]);},onChangeMonthYear:function(month,year,inst){$(this).trigger('mepr-date-picker-changed',[month,year,inst]);},onClose:function(date,inst){$(this).val(date.trim());$(this).trigger('mepr-date-picker-closed',[date,inst]);}});});