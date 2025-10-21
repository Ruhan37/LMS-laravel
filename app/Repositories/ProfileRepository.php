<?php


namespace App\Repositories;

use App\Models\User;
use App\Traits\FileUploadTrait; // Import the FileUploadTrait
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileRepository
{
    use FileUploadTrait; // Use the FileUploadTrait

    public function findProfile()
    {
        $user_id = Auth::user()->id;
        return User::where('id', $user_id)->first();
    }

    public function createOrUpdateProfile($data, $photo)
    {
        $profile = $this->findProfile();

        // Handle file uploads manually
        if ($photo) {
            try {
                $data['photo'] = $this->uploadFile($photo, 'user', $profile->photo);
            } catch (\Exception $e) {
                Log::error('Profile photo upload failed', [
                    'user_id' => $profile->id,
                    'error' => $e->getMessage()
                ]);
                throw new \Exception('Photo failed to upload: ' . $e->getMessage());
            }
        }

        // Manually assign other fields from $data
        $profile->update($data);

        return $profile;
    }
}
