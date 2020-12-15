<?php

namespace App\Support;

use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Http\FormRequest;

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
            'sectionName' => AdminController::SECTION_NAME[$section],
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
        $list['id'] = '';

        $section = $this->getRouteSection();

        return view('admin.edit', [
            'title' => __('admin.add_element'),
            'actionType' => 'add',
            'section' => $section,
            'sectionName' => AdminController::SECTION_NAME[$section],
            'list' => $list,
            'imageToShow' => $this->getImagePath(),
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

        $imageName = '';
        if (self::HAS_IMAGE) {
            $imgField = self::IMAGE_FIELD_NAME;
            $imageName = $element->$imgField;
        }

        $section = $this->getRouteSection();

        return view('admin.edit', [
            'title' => __('admin.edit_element'),
            'actionType' => 'edit',
            'section' => $section,
            'sectionName' => AdminController::SECTION_NAME[$section],
            'list' => $element->toArray(),
            'id' => $id,
            'imageToShow' => $this->getImagePath($imageName)
        ]);
    }

    /**
     * Обновление записи
     * @param FormRequest $request
     * @param             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateElement(FormRequest $request, $id)
    {
        $element = $this->getElement($id);

        if (!$element) {
            return $this->redirectBackEror(__('admin.error.edit_element_not_found'));
        }

        // @todo добавить сесурити
        // if (Gate::denies('update', $element)){}

        $fields = $this->getFields();
        $data = $request->only($fields);

        $file = $this->uploadImage($request);
        if (!empty($file)) {
            $data[self::IMAGE_FIELD_NAME] = $file;
        }

        $element->fill($data);

        if ($element->save()) {
            Pages::forgetCache(self::SECTION_NAME);

            return redirect()->back()->with('status', __('admin.change_saved'));
        }

        return $this->redirectBackEror(__('admin.error.data_save'));
    }

    /**
     * Создание записи
     * @param FormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createElement(FormRequest $request)
    {
        $element = 'App\Models\\' . self::SECTION_NAME;

        $data = $request->only($this->getFields());

        $file = $this->uploadImage($request);
        if (!empty($file)) {
            $data[self::IMAGE_FIELD_NAME] = $file;
        }

        $res = $element::create($data);

        if ($res) {
            Pages::forgetCache(self::SECTION_NAME);

            return redirect()->back()
                ->with('id', $res->id)
                ->with('section', $this->getRouteSection())
                ->with('status', __('admin.element_added'));
        }

        return $this->redirectBackEror(__('admin.error.data_add'));
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
            return $this->redirectBackEror(__('admin.error.data_add'));
        }

        $res = $element->delete();

        if (!$res) {
            return $this->redirectBackEror(__('admin.error.date_delete'));
        }

        Pages::forgetCache(self::SECTION_NAME);

        return redirect()->back()->with('status', __('admin.element_deleted'));
    }

    /**
     * Получение всех данных из модели SECTION_NAME
     * @return array
     */
    private function getDataList(): array
    {
        return Pages::getModelData(self::SECTION_NAME, true);
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
     * @param FormRequest $request
     * @return string
     */
    private function uploadImage(FormRequest $request): string
    {
        if (self::HAS_IMAGE && $request->hasFile(self::IMAGE_FIELD_NAME)) {
            $upload = $request->file(self::IMAGE_FIELD_NAME);

            if ($upload->isValid()) {
                $targetDir = public_path() . '/assets/img/' . $this->getRouteSection();
                $targetFile = $upload->getClientOriginalName();
                // переименовываем файл если существует
                if (file_exists($targetDir . $targetFile)) {
                    $file = pathinfo($targetFile);
                    $targetFile .= $file['filename'] . '_' . date('ymd_his') . $file['extension'];
                }
                $upload->move($targetDir, $targetFile);

                return $targetFile;
            }
        }

        return '';
    }

    /**
     * Возвращает относительный путь изображения для формы редактирования
     * если указанное в таблице не задано или не существует, то путь к дефолтному изображению
     * @param string $image
     * @return string
     */
    private function getImagePath(string $image = ''): string
    {
        // Изображение по умолчанию, если не задано
        $imageToShow = 'no_image.png';
        // путь к изображениям
        $path = '/assets/img/';

        if (self::HAS_IMAGE && !empty($image)) {
            // загруженные изображения хранятся в подкаталогах секции
            $img = $this->getRouteSection() . '/' . $image;
            if (file_exists(public_path() . $path . $img)) {
                $imageToShow = $img;
            }
        }

        return $path . $imageToShow;
    }
}
