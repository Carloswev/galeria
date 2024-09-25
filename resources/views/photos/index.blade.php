<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Galeria de Fotos</title>
</head>
<body>
    <header>
        <h1>Galery</h1>
        <nav>
            <ul>
                <li><a href="{{ route('photos.index') }}">Home</a></li>
                <li><a href="#" id="add-album">Album</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="upload-section">
            <h2>Adicionar Fotos</h2>
            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="drop-area">
                    <p>Arraste e solte suas imagens aqui ou clique para selecionar arquivos.</p>
                    <input type="file" id="fileElem" name="photos[]" multiple accept="image/*" style="display:none;" onchange="handleFiles(this.files)">
                    <label for="fileElem" class="drop-zone">Clique para selecionar imagens</label>
                    <div class="gallery" id="gallery"></div>
                </div>
                <button type="submit" class="submit-button">Adicionar Imagens</button>
            </form>
        </section>

        <section class="gallery-section">
    <h2>Nossa Galeria</h2>
    <div class="photos-grid">
        @foreach ($photos as $photo)
            <div class="photo-card">
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->name }}" onclick="openModal(this)">
                <div class="photo-info">
                    <h5>{{ $photo->name }}</h5>
                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Excluir</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>
    </main>

    <footer>
        <p>&copy; CinkSano
        </p>
    </footer>

    <div id="modal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modal-img">
        <div id="caption"></div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
