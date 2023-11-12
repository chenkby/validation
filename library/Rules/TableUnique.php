<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Illuminate\Database\Eloquent\Model;

/**
 * 验证是否数据表唯一
 */
final class TableUnique extends AbstractRule
{
    /**
     * @var Model 要查询的model
     */
    private Model $model;

    /**
     * @var int|string|null 主键值
     */
    private int|string|null $id;

    /**
     * @var string 要查询的字段
     */
    private string $field;

    /**
     * @param string|Model $model
     * @param string|int|null $id 主键值
     * @param string $field 要查询的字段名称
     */
    public function __construct(string|Model $model, string|int |null $id = null, string $field = 'name')
    {
        $this->model = (new $model());
        $this->id = $id;
        $this->field = $field;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        if ($input) {
            $query = $this->model::query()->select($this->model->getKeyName())->where($this->field, $input);
            if ($this->id) {
                $query->where($this->model->getKeyName(), '<>', $this->id);
            }

            return !$query->exists();
        }

        return false;
    }
}
