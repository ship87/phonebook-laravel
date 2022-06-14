<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Phonebook</title>
</head>
<body>


<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-sm">Id</div>
                <div class="col-sm">Имя</div>
                <div class="col-sm">Краткое описание</div>
                <div class="col-sm">Изображение</div>
                <div class="col-sm">Телефон</div>
            </div>
        </div>

        <div class="container" id="table-cards">
        </div>

    </div>
</div>

<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <form class="col-12" id="form-add-card" method="POST" enctype="multipart/form-data"
              action="{{ route('api.cards.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" required class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="short_description">Краткое описание</label>
                <textarea class="form-control" id="short_description" name="short_description"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" required class="form-control" id="phone" name="phone">
            </div>


            <div class="form-group">
                <div class="btn-group">
                    <button type="submit" name="next_action" value="save" class="btn btn-primary">
                        <i class="fa fa-check"></i> Отправить
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {

        let urlApiGetCards = '{{ route('api.cards.get') }}';
        showCards();
        $("#form-add-card").submit(function (e) {

            e.preventDefault();
            let form = $(this);
            let actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.success) {
                        alert('Запись успешно добавлена.');
                        showCards();
                    } else {
                        alert('Ошибка. ' + data.errors);
                    }
                }
            });
        });

        function showCards() {
            $.ajax({
                url: urlApiGetCards,
                type: 'GET',
                dataType: 'json',
                data: {},
                success: function (data) {

                    let htmlData = '';
                    for (var card in data) {
                        htmlData = htmlData + '<div class="row">' +
                            '<div class="col-sm">' + data[card].id + '</div>' +
                            '<div class="col-sm">' + data[card].name + '</div>' +
                            '<div class="col-sm">' + (data[card].short_description ? data[card].short_description.length : '') + '</div>' +
                            '<div class="col-sm">' + (data[card].image ? '<img width="100" height="100" src="/storage/cards/' + data[card].image + '">' : '') + '</div>' +
                            '<div class="col-sm">' + data[card].phone + '</div>' +
                            '</div>';
                    }

                    $('#table-cards').html(htmlData);
                }
            });
        }
    });
</script>

</body>
</html>
