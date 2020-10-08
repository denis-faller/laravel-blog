@if (count($errors) > 0)
  @if($errors->has('subscriber_email'))
  <!-- Список ошибок формы -->
  <div class="alert alert-danger">
    <strong>При заполнении данных вы совершили следующие ошибки</strong>

    <br><br>

    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
@endif