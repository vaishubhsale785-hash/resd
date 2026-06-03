<?php
require "config.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Britannia Rewards</title>
<link rel="stylesheet" href="assets/style.css">
<script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>

<div class="card">
  <div class="brand">BRITANNIA</div>
  <div class="subtitle">Join all channels to continue</div>

  <?php foreach($CHANNELS as $username => $name): ?>
    <div class="channel">
      <span><?= htmlspecialchars($name) ?></span>
      <a href="https://t.me/<?= $username ?>" target="_blank">Join</a>
    </div>
  <?php endforeach; ?>

  <button onclick="verify()">VERIFY MEMBERSHIP</button>
</div>

<script>
let tg = window.Telegram.WebApp;
tg.expand();

function verify(){
  if(!tg.initDataUnsafe.user){
    alert("Open inside Telegram");
    return;
  }

  fetch("verify.php", {
    method:"POST",
    headers:{'Content-Type':'application/json'},
    body:JSON.stringify({
      user_id: tg.initDataUnsafe.user.id
    })
  })
  .then(res => res.json())
  .then(d => {
    if(d.status === "ok"){
      window.location.href = "https://claims.britanniarewards.in";
    } else {
      alert("Please join all channels first!");
    }
  });
}
</script>

</body>
</html>
