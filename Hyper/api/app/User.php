<?php

namespace App;

use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Role\RoleModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'numbrs_id',
        'gender_id',
        'alias',
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'country_id',
        'nationality',
        'maritalstatus_id',
        'drivers_license',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_of_birth_id');
    }

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class);
    }

    public function maritalstatus()
    {
        return $this->hasOne(MaritalStatus::class);
    }

    public function nationality()
    {
        return $this->hasOne(Nationality::class);
    }

    public function forgotPasswordTokens()
    {
        return $this->hasMany(ForgotPasswordToken::class);
    }

    public function contracts()
    {
        return $this->hasMany(EmploymentContract::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function schedules()
    {
        return $this->belongsToMany(
            Schedule::class,
            'employee_schedule',
            'user_id',
            'schedule_id',
            'id',
            'id'
        );
    }

    public function worksOnProject()
    {
        return $this->belongsToMany(
            Project::class,
            'works_on_project'
        );
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'user_id');
    }

    public function scopeId($query, $id)
    {
        $id ? $query->where('users.id', 'LIKE', '%' . $id . '%') : null;
    }

    public function scopeAlias($query, $alias)
    {
        $alias ? $query->where('users.alias', 'LIKE', '%' . $alias . '%') : null;
    }

    public function scopeInitials($query, $initials)
    {
        $initials ? $query->where('users.initials', 'LIKE', '%' . $initials . '%') : null;
    }

    public function scopeFirstName($query, $first_name)
    {
        $first_name ? $query->where('users.first_name', 'LIKE', '%' . $first_name . '%') : null;
    }

    public function scopeInsertion($query, $insertion)
    {
        $insertion ? $query->where('users.insertion', 'LIKE', '%' . $insertion . '%') : null;
    }

    public function scopeLastName($query, $last_name)
    {
        $last_name ? $query->where('users.last_name', 'LIKE', '%' . $last_name . '%') : null;
    }

    public function scopePhone($query, $phone)
    {
        $phone ? $query->where('users.phone', 'LIKE', '%' . $phone . '%') : null;
    }

    public function scopeIsDriver($query, $isDriver)
    {
        ($isDriver !== null) ? $query->where('users.has_drivers_license', $isDriver) : null;
    }

    public function scopeBirthDate($query, $date_of_birth)
    {
        $date_of_birth ? $query->where('users.date_of_birth', 'LIKE', '%' . $date_of_birth . '%') : null;
    }

    public function scopeBirthCountryId($query, $country_of_birth_id)
    {
        $country_of_birth_id ? $query->where('users.country_of_birth_id', 'LIKE', '%' . $country_of_birth_id . '%') : null;
    }

    public function scopeNationalityId($query, $nationality_id)
    {
        $nationality_id ? $query->where('users.nationality_id', 'LIKE', '%' . $nationality_id . '%') : null;
    }

    public function scopeMaritalStatusId($query, $marital_status_id)
    {
        $marital_status_id ? $query->where('users.marital_status_id', 'LIKE', '%' . $marital_status_id . '%') : null;
    }

    public function scopeEmail($query, $email)
    {
        $email ? $query->where('users.email', 'LIKE', '%' . $email . '%') : null;
    }

    public function scopeIban($query, $iban)
    {
        $iban ? $query->where('users.iban', 'LIKE', '%' . $iban . '%') : null;
    }

    public function scopeIncomeTax($query, $income_tax)
    {
        $income_tax ? $query->where('users.income_tax', 'LIKE', '%' . $income_tax . '%') : null;
    }

    public function scopeRoleId($query, $role_id)
    {
        $role_id ? $query->where('users.role_id', 'LIKE', '%' . $role_id . '%') : null;
    }

    public function scopeRole($query, ?RoleModel $role)
    {
        if (!$role) {
            return null;
        }

        $role->getTitle() ? $query->whereHas('role', function ($query) use ($role) {
            $query->where('title', 'LIKE', '%' . $role->getTitle() . '%');
        }) : null;
    }

    public function scopeSearch($query, PaginationEmployeeModel $paginationEmployeeModel)
    {
        $employee = $paginationEmployeeModel->getEmployee();

        $query->Id(methodExistOrNull($employee, 'getId'))
            ->Alias(methodExistOrNull($employee, 'getAlias'))
            ->Initials(methodExistOrNull($employee, 'getInitials'))
            ->FirstName(methodExistOrNull($employee, 'getFirstName'))
            ->Insertion(methodExistOrNull($employee, 'getInsertion'))
            ->LastName(methodExistOrNull($employee, 'getLastName'))
            ->Phone(methodExistOrNull($employee, 'getPhone'))
            ->isDriver(methodExistOrNull($employee, 'isHasDriversLicense'))
            ->BirthDate(methodExistOrNull($employee, 'getDateOfBirth'))
            ->BirthCountryId(methodExistOrNull($employee, 'getCountryOfBirthId'))
            ->NationalityId(methodExistOrNull($employee, 'getNationalityId'))
            ->MaritalStatusId(methodExistOrNull($employee, 'getMaritalStatusId'))
            ->Email(methodExistOrNull($employee, 'getEmail'))
            ->Iban(methodExistOrNull($employee, 'getIban'))
            ->IncomeTax(methodExistOrNull($employee, 'isIncomeTax'))
            ->RoleId(methodExistOrNull($employee, 'getRoleId'))
            ->Role(methodExistOrNull($employee, 'getRole'));

        return $query->get();
    }
}
