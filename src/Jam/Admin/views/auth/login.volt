<div class="login-form">
    <img src="/img/logo_200.png" alt="JAM" class="logo">
    {{ partial('partials/flash') }}
    <form method="post">
      <input type="email" name="email" class="form-control" placeholder="Please enter your email address..." required="required">
      <input type="password" name="password" class="form-control" placeholder="Please enter your password..." required="required">
      <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}"/>
      <button type="submit" class="btn btn-success">Login</button>
    </form>
</div>