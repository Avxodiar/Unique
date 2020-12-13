<?php

namespace App\Support;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

trait SectionTrait
{
    /**
     * Отображение списка материалов и операций над ними
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showIndex()
    {
        // используется для формирования маршрута добавления материала в секцию
        $section = $this->getRouteSection();
        // для отображения выбранной активной секции с которой доступны действия
        $sectionActive = AdminController::ACTION_ACTIVE;
        $sectionActive[$section] = 'active';

        return view('admin.index', [
            'section' => $section,
            'sectionActive' => $sectionActive,
            'fields' => self::INDEX_FIELDS,
            'list' => $this->getDataList(),
        ]);
    }

    /**
     * Отображение формы добавления материала
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAddForm()
    {
        // список данных по полям заполняем пустими значениями
        $list = array_fill_keys($this->getFields(), '');
        $list['id'] = 0;

        return view('admin.edit', [
            'title' => 'Добавление элемента',
            'actionType' => 'add',
            'section' => $this->getRouteSection(),
            'list' => $list,
            'noImage' => true,
        ]);
    }

    /**
     * Отображение формы редактирования материала
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showEditForm($id)
    {
        $element = $this->getElement($id);

        if (!$element) {
            abort(404);
        }

        // существует ли изображение для материала
        $noImage = true;
        if (self::HAS_IMAGE) {
            $imgField = self::IMAGE_FIELD_NAME;
            if (!empty($element->$imgField)) {
                $dir = public_path() . '/assets/img/' . $this->getRouteSection();
                $noImage = !file_exists($dir . '/' . $element->$imgField);
            }
        }

        return view('admin.edit', [
            'title' => 'Редактирование элемента',
            'actionType' => 'edit',
            'section' => $this->getRouteSection(),
            'list' => $element->toArray(),
            'id' => $id,
            'noImage' => $noImage,
        ]);
    }

    /**
     * Обновление записи
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $element = $this->getElement($id);

        if (!$element) {
            return $this->redirectBackEror('Редактируемая запись не найдена');
        }

        // @todo добавить сесурити
        // if (Gate::denies('update', $element)){}

        $fields = $this->getFields();
        $data = $request->only($fields);

        if (self::HAS_IMAGE) {
            $imgField = self::IMAGE_FIELD_NAME;

            // если выбрано поле radio-image то нужно загрузить файл
            if (isset($request['radio-image']) && $request['radio-image'] === 'file') {
                if ($this->uploadImage($request, $imgField)) {
                    $upload = $request->file($imgField);
                    $data[$imgField] = $upload->getClientOriginalName();
                } else {
                    return $this->redirectBackEror('Не указан загружаемый файл');
                }
            }
        }

        $element->fill($data);

        if ($element->save()) {
            Pages::forgetCache(self::SECTION_NAME);

            return redirect()->back()->with('status', 'Изменения сохранены');
        }

        return $this->redirectBackEror('Ошибка сохранения данных');
    }

    /**
     * Создание записи
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @todo Validation
     *       'name' => 'required|max:255',
     *       'alias' => 'required|unique:pages|max:255',
     *       'text' => 'required',
     *       'images' => 'required',
     *
     */
    public function create(Request $request)
    {
        $element = 'App\Models\\' . self::SECTION_NAME;

        $data = $request->only($this->getFields());

        $res = $element::create($data);

        if ($res) {
            Pages::forgetCache(self::SECTION_NAME);

            return redirect()->back()
                ->with('id', $res->id)
                ->with('section', $this->getRouteSection())
                ->with('status', 'Запись успешно добавлена');
        }

        return $this->redirectBackEror('Ошибка добавления данных');
    }

    /**
     * Удаление записи
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $element = $this->getElement($id);

        if (!$element) {
            return $this->redirectBackEror('Удаляемая запись не найдена');
        }

        $res = $element->delete();

        if (!$res) {
            return $this->redirectBackEror('Ошибка удаления записи');
        }

        Pages::forgetCache(self::SECTION_NAME);

        return redirect()->back()->with('status', 'Запись удалена');
    }

    /**
     * Получение данных из модели SECTION_NAME
     * @return array
     */
    private function getDataList(): array
    {
        return Pages::getModelData(self::SECTION_NAME);
    }

    /**
     * Возвращает список необходимых полей
     * @return array
     */
    private function getFields(): array
    {
        return Pages::MODEL_FIELDS[self::SECTION_NAME];
    }

    /**
     * Возвращает имя секции маршрута для формирования имени маршрута в шаблоне
     * @return string
     */
    private function getRouteSection(): string
    {
        return strtolower(self::SECTION_NAME);
    }

    /**
     * Редирект с ошибкой
     * @param string $error
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectBackEror(string $error)
    {
        return redirect()->back()->withInput()->withErrors([
            'formError' => $error,
        ]);
    }

    /**
     * Загрузка файла
     * @param Request $request
     * @param         $fieldName - имя поля загружаемого файла
     * @return bool
     */
    public function uploadImage(Request $request, $fieldName): bool
    {
        $upload = $request->file($fieldName);

        if ($request->hasFile($fieldName) && $upload->isValid()) {
            $targetDir = public_path() . '/assets/img/' . $this->getRouteSection();
            $targetFile = $upload->getClientOriginalName();
            $upload->move($targetDir, $targetFile);

            return true;
        }

        return false;
    }
}
