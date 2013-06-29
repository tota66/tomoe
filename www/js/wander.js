$(function() {
    
    $('#test').bind('click', function() {
        alert("test!");
    });
    
    var Command = {
        start_session: function() {
            $.ajax("api/path", {
                'data': {
                    'key': 'value'
                },
                'success': function(data) {
                    alert('success');
                },
                'error': function(xhr, msg) {
                    alert('error ' + msg);
                }
            });
        },
        move: function() {
            $.ajax("api/path", {
                'data': {
                    'key': 'value'
                },
                'success': function(data) {
                    alert('success');
                },
                'error': function(xhr, msg) {
                    alert('error ' + msg);
                }
            });
        },
    };
    $('#ajax_test').bind('click', Command.move);
});
