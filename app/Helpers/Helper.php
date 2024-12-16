<?php

namespace App\Helpers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function permission($permissions, $parent_id = 0, $char = '')
    {
        $html = '';
        $allPermissions = Permission::all()->keyBy('id');

        foreach ($permissions as $key => $permission) {
            if ($permission->parent_id == $parent_id) {
                $editUrl = route('permission.edit', $permission->id);
                $deleteUrl = route('permission.destroy', $permission->id);
                $parentName = $permission->parent_id && isset($allPermissions[$permission->parent_id])
                    ? $allPermissions[$permission->parent_id]->name
                    : '<span class="btn btn-info btn-sm">No</span>';
                $canEdit = Auth::user()->can('edit permission');
                $canDelete = Auth::user()->can('delete permission');

                $html .= '
                    <tr>
                        <td>' . e($permission->id) . '</td>
                        <td>' . e($char . $permission->name) . '</td>
                        <td>' . $parentName . '</td>
                        <td>';

                if ($canEdit) {
                    $html .= '<a href="' . e($editUrl) . '" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                              </a>';
                }

                if ($canDelete) {
                    $html .= '
                        <form action="' . e($deleteUrl) . '" method="POST" style="display: inline" class="delete-form">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                            <button class="btn btn-danger btn-sm delete-btn" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>';
                }

                $html .= '</td></tr>';

                unset($permissions[$key]);

                $html .= self::permission($permissions, $permission->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($status = 0, $id, $message): string
    {
        return $status == 0 ? '<span class="btn btn-danger btn-sm changeStatus" data-slug="' . $message . '" data-id="' . $id . '">Không hoạt động</span>'
            : '<span class="btn btn-success btn-sm changeStatus" data-slug="' . $message . '" data-id="' . $id . '">Hoạt động</span>';
    }
}
