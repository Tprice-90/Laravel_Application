@csrf

<label for="name">Name:</label>
<input name="name" type="text" value="{{ $name ?? '' }}"><br>
<label for="description">Description:</label>
<input name="description" type="text" value="{{ $description ?? '' }}"><br>
<input type="submit" value="{{ $buttonName }}"><br>
