// JavaScript Document


$('a[data-toggle="tab"]').on('shown', function () {
    $('.selectpicker').selectpicker('setSize');
});

var pageImages = [];
var pageNum = 1;
/**
 * Reset numbering on tab buttons
 */


$(document).ready(function () {

    /**
     * Add a Tab
     */

    $('li').click(function () {

        pageNum++;
        var validar = $(this).attr('rel');
        var validar2 = $.trim(validar);

        if (validar2 == "")
        {
        } else
        {
            var dato = $(this).text();
            $('#pageTab').append(
                    $('<li><a href="#page' + pageNum + '">' + dato +
                            '<button class="close" type="button" ' +
                            'title="Remove this page">   ×</button>' +
                            '</a></li>'));
            var url = $(this).attr('rel');




            $('#pageTabContent').append(
                    $('<div class="tab-pane" id="page' + pageNum + '"><iframe class="embed-responsive-item" src=' + url + ' width="100%" height="100%" frameborder="0" scrolling="yes" id="iframe"></iframe></div>'));

            $('#pageTab  a[href=#page' + pageNum + ']').tab('show');

        }
    });

    /**
     * Remove a Tab
     */
    $('#pageTab').on('click', ' li a .close', function () {
        var tabId = $(this).parents('li').children('a').attr('href');
        $(this).parents('li').remove('li');
        $(tabId).remove();

        $('#pageTab a:first').tab('show');

    });

    /**
     * Click Tab to show its content 
     */
    $("#pageTab").on("click", "a", function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});


			