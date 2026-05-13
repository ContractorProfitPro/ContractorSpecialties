<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractorProfile extends Model
{
    use HasFactory;

    // Mapping to your custom table prefix
    protected $table = 'sc_contractor_profiles';

    // Allowing mass assignment for rapid building
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // This is crucial: Tells Laravel to seamlessly convert our DB JSON into usable arrays
    protected $casts = [
        'social_links' => 'array',
        'services_offered' => 'array',
        'portfolio_images' => 'array',
        'allow_messaging' => 'boolean',
        'offers_emergency_service' => 'boolean',
        'is_licensed' => 'boolean',
        'is_insured' => 'boolean',
        'warranty_offered' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * A profile belongs to a single user account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}