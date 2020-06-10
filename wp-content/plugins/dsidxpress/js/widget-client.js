var dsidx_w = {};

dsidx_w.searchWidget = (function () {
	var $ = jQuery;

	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-type-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-Cities<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-city-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').select2({ placeholder: "Any" });	

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-Communities<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-community-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-TractIdentifiers<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-tract-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-ZipCodes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-zip-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').select2({ placeholder: "Any" });		
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-quick-search-type-hidden-inputs').html(input_html);
	});	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change();

	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').select2({ placeholder: "All Types" });		
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-quick-search-type-hidden-inputs').html(input_html);
	});	
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change();

	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').select2({ placeholder: "All Statuses" });		
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').change(function () {
	    var statusEnumHash = 0;
	    $(this).find('option:selected').each(function () {
	        statusEnumHash += parseInt($(this).val());
		});		
		$(this).siblings('#dsidx-quick-search-status-hidden').val(statusEnumHash);
	});	
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').change();

    function isLocationValid() {
        // Deactivating the location validation for case 9360
        // We will now accept no location fields and the - Any - value
        // This file doesn't do anything now.
    	var valid = true;
    	$('.idx-q-Location-Filter :selected').each(function(index) {
    		if($(this).val().length)
    			valid = true;
    	});
    	return valid;
    }   
    
    function isFieldShown() {
    	var returnStr = "";
    	$('.idx-q-Location-Filter').each( function() {
    		returnStr += $("label[for=" + $(this).attr('id') + "]").text() + ", ";
    	});
    	return returnStr.substring(0, returnStr.length - 2);
    }
    
    function MLSExists() {
    	if ($('#idx-q-MlsNumbers').length > 0 && $('#idx-q-MlsNumbers').val().length > 0)
    		return true;
    	else
    		return false;
    }
    
    var returnObj = {
    	validate: function () {
            if (!isLocationValid() && !MLSExists())
            {
            	$("#idx-search-invalid-msg").text("Please select at least one of the following fields: " + isFieldShown()).show();
            	return false;
            }
            else
            	return true;
        }
    };
    
    return returnObj;
})();