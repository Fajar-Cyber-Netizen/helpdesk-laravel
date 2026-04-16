<h1>Helpdesk Ticketing System</h1>

<form method="POST" action="/tickets">
    @csrf

    <input type="text" name="title" placeholder="Keluhan"><br><br>

    <textarea name="description" placeholder="Detail Keluhan"></textarea><br><br>

    <select name="category">
        <option value="">Pilih Kategori</option>
        <option value="hardware">Hardware</option>
        <option value="software">Software</option>
        <option value="network">Network</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>