<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
</head>
<body>
  <h1>Home Page</h1>
  <ul>
    <?php foreach($data['names'] as $name): ?>
    <li><?php echo $name; ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>