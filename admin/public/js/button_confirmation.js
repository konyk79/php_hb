$(document).ready(function() {
    $(document).on('click','.need_confirmation',function(event) {
        if (!confirm('Are you sure to terminate subscription?')) {
            event.preventDefault();
        }
    });
});