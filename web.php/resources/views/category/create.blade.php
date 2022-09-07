<form action="/category/create" method="POST">
    @csrf
    Nome da Categoria: <input type="text" name="name">
    <button type="submit">Enviar</button>
</form>
