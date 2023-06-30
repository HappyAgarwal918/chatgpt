<!DOCTYPE html>
<html>
<head>
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
            // Set the CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            $('#prompt-form').submit(function(event) {
                event.preventDefault();
                var prompt = $('#prompt-input').val();
                $.post('/chatbot/get-response', { prompt: prompt }, function(data) {
                    $('#chatbox').append('<p><strong>You:</strong> ' + prompt + '</p>');
                    $('#chatbox').append('<p><strong>Chatbot:</strong> ' + data.message + '</p>');
                    $('#prompt-input').val('');
                });
            });
        });
    </script>
    <!-- Other meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <h1>Chatbot</h1>
        <div id="chatbox"></div>
        <form id="prompt-form">
            <div class="form-group">
                <label for="prompt-input">Enter a prompt:</label>
                <input type="text" class="form-control" id="prompt-input" name="prompt">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>