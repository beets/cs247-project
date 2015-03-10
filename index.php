<? include 'templates/header.html' ?>
<style>
body {
  padding-top: 40px;
  padding-bottom: 40px;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin h1 {
  margin-bottom: 1em;
}
.form-signin .form-control {
  margin-bottom: 2em;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
</style>
    <div id="request" class="container">
        <form action="timeline.php" method="get" class="form-signin">
            <h1>Moments</h1>
            <input name="family" type="text" value="test" placeholder="Family name" class="form-control" />
            <button type="submit" class="btn btn-lg btn-primary btn-block">Enter</button>
        </form>
    </div>
<? include 'templates/footer.html' ?>
