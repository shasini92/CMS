$(document).ready(function () {

    $('#selectAllBoxes').click(function (event) {

        if (this.checked) {

            $('.checkboxes').each(function () {

                this.checked = true;

            })
        } else {
            $('.checkboxes').each(function () {

                this.checked = false;

            })
        }
    });

    // This section makes a screen load function
    // Prepend function adds a first child to a selected element

    /*    let div_box = "<div id='load-screen'><div id='loading'></div></div>";

        $('body').prepend(div_box);

        $('#load-screen').delay(700).fadeOut(600, function (){$(this).remove()});
        */


});
