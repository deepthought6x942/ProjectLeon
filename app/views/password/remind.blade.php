
To send a reminder, enter your email address in the space provided.

<form action="{{ action('RemindersController@store') }}" method="POST">
    <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form>
