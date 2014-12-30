/**
 * Created by garrettblakeman on 12/29/14.
 */
$(document).ready(function() {
/** Magic with colors */

    // dropdown color changes

    $('#colorDrop1').change(function() {
        $('#feature').animate({backgroundColor: '#' + $(this).val() });
    }).animate();

    $('#colorDrop2').change(function() {
        $('#leftHome').animate({backgroundColor: '#' + $(this).val() });
    }).animate();

    // color change on submit


/** AJAX Form Processing */

    $('form').submit(function(event) {

        $('.form-group').removeClass('has-error');
        $('.help-block').remove(); // remove the error text

        // get the data
        var formData = {
            'colorDrop1' 		: $('#colorDrop1 :selected').val(),
            'colorDrop2' 		: $('#colorDrop2 :selected').val(),
            'name' 				: $('input[name=name]').val()
        };

        // process the form
        $.ajax({
            type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url 		: 'form-process.php', // the url where we want to POST
            data 		: formData, // our data object
            dataType 	: 'json', // what type of data do we expect back from the server
            encode 		: true
        })

            .done(function(data) {

                // enable console log for debugging
                 console.log(data);

                // error display handling
                if ( ! data.success) {
                    if (data.errors.colorDrop1) {
                        $('#colorDrop1-group').addClass('has-error');
                        $('#colorDrop1-group').append('<div class="help-block">' + data.errors.colorDrop1 + '</div>');
                    }
                    if (data.errors.colorDrop2) {
                        $('#colorDrop2-group').addClass('has-error'); // add the error class to show red input
                        $('#colorDrop2-group').append('<div class="help-block">' + data.errors.colorDrop2 + '</div>');
                    }

                    if (data.errors.name) {
                        $('#name-group').addClass('has-error');
                        $('#name-group').append('<div class="help-block">' + data.errors.name + '</div>');
                    }

                } else {

                    // success message
                    $('html body').animate({ backgroundColor: '#' + data.newColor });
                    $('#colorForm').append('<div class="alert alert-success" style="background-color:#' + data.newColor + '">' + data.message + '</div>');
                    // reload page after form data is saved
                    // TODO-me add countdown or notification of refresh
                    setTimeout(function() {
                        location.reload();
                    }, 3500);

                }
            })

            // using the fail promise callback
            .fail(function(data) {

                // show errors in console for debugging
                 console.log(data);
            });

        // Don't leave the page right away
        event.preventDefault();
    });

});