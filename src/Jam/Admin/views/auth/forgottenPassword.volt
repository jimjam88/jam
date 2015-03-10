<div class="login-form">
  <h3>Ah, crumbs!</h3>
  <p><b>You've forgotten your password! Not to worry...</b></p>
  <p>Enter your details below and we'll send you an email detailing how you can reset it.</p>
  {{ partial('partials/flash') }}
  <form method="post">
      <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}"/>
      <input type="email" name="email" class="form-control" placeholder="Please enter your email address..." required="required">
      <input type="text" name="lastName" class="form-control" placeholder="Please enter your last name..." required="required">
      <button type="submit" class="btn btn-success">Send Email</button>
  </form>
</div>