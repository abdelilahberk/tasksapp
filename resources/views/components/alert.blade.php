@if (session()->has('succes'))

<div class="alert alert-primary" role="alert"
    style="background-color: #42ba96 ; padding: 20px; color: white;  margin-bottom: 15px;">
    <!-- red #f44336 -->
    <!-- success #42ba96 	  -->
    {{ session()->get('succes') }}
</div>
@endif
@if (session()->has('error'))

<div class="alert alert-primary" role="alert"
    style="background-color: #f44336 ; padding: 20px; color: white;  margin-bottom: 15px;">
    <!-- red #f44336 -->
    <!-- success #42ba96 	  -->
    {{ session()->get('error') }}
</div>
@endif