@php
    /** @ver \App\Model\BlogCategory $item */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title"
                                   type="text"
                                   id="title"
                                   value="{{ $item->title }}"
                                   class="form-control"
                                   minlength="3"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор - slug</label>
                            <input type="text"
                                   class="form-control"
                                   name="slug"
                                   value="{{ $item->slug }}"
                                   id="slug"
                            >
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id" class="form-control" placeholder="Выбери категорию" required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->parent_id) selected @endif>
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      rows="3"
                                      class="form-control">{{ old('description', $item->description) }}
                            </textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>