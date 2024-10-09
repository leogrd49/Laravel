<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtient les règles de validation qui s'appliquent à la requête.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.($userId && is_object($userId) && method_exists($userId, 'getKey') ? $userId->getKey() : 'NULL'),
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
