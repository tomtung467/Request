# HƯỚNG DẪN CÀI ĐẶT MODULE UNIT

Module Unit này được viết theo đúng convention của project để training member.

## QUAN TRỌNG: Hiểu về Architecture Pattern

Module này follow pattern: **IBaseRepository → BaseRepository → Service → Controller**

```
IBaseRepository (interface)
    ↓ extends
IUnitRepository (interface)
    ↓ implements
BaseRepository (base class)
    ↓ extends
UnitRepository (concrete class)
    ↓ inject via DI
UnitService (extends BaseService)
    ↓ inject
UnitController (extends BaseApiController)
```

## Bước 1: Copy files vào project

### 1.1. Copy Migration
```bash
cp database/migrations/create_units_table.php ../database/migrations/2024_12_18_000001_create_units_table.php
```

### 1.2. Copy Seeder
```bash
cp database/seeders/UnitSeeder.php ../database/seeders/
```

### 1.3. Copy Model
```bash
cp app/Models/Unit.php ../app/Models/
```

### 1.4. Copy Repository Interface + Implementation
```bash
# Tạo folder Unit nếu chưa có
mkdir -p ../app/Repositories/Unit

# Copy interface
cp app/Repositories/Unit/IUnitRepository.php ../app/Repositories/Unit/

# Copy implementation
cp app/Repositories/Unit/UnitRepository.php ../app/Repositories/Unit/
```

### 1.5. Copy Service
```bash
cp app/Services/UnitService.php ../app/Services/
```

### 1.6. Copy Controller
```bash
cp app/Http/Controllers/Api/UnitController.php ../app/Http/Controllers/Api/
```

### 1.7. Copy Request Validation
```bash
# Tạo folder Unit nếu chưa có
mkdir -p ../app/Http/Requests/Unit

# Copy files
cp app/Http/Requests/Unit/CreateUnitRequest.php ../app/Http/Requests/Unit/
cp app/Http/Requests/Unit/UpdateUnitRequest.php ../app/Http/Requests/Unit/
```

### 1.8. Copy Policy
```bash
cp app/Policies/UnitPolicy.php ../app/Policies/
```

### 1.9. Copy Filter (nếu có)
```bash
# Nếu có UnitFilter
cp app/Filters/UnitFilter.php ../app/Filters/
```

## Bước 2: QUAN TRỌNG - Khai báo DI trong AppServiceProvider

Mở file `app/Providers/AppServiceProvider.php`

Tìm mảng `$_listRepoMapInterface` (khoảng dòng 20-400)

Thêm dòng sau vào mảng:

```php
protected $_listRepoMapInterface = [
    // ... existing interfaces
    
    IUnitRepository::class => UnitRepository::class, // <-- Thêm dòng này
    
    // ... other interfaces
];
```

Thêm use statement ở đầu file:

```php
use App\Repositories\Unit\IUnitRepository;
use App\Repositories\Unit\UnitRepository;
```

**GIẢI THÍCH:**
- Laravel sẽ tự động bind Interface → Implementation
- Khi UnitService inject `IUnitRepository`, Laravel sẽ tự resolve thành `UnitRepository`
- Điều này giúp dễ test và thay đổi implementation sau này

## Bước 3: Register Policy trong AuthServiceProvider

Mở file `app/Providers/AuthServiceProvider.php`

Thêm vào mảng `$policies`:

```php
protected $policies = [
    // ... existing policies
    
    \App\Models\Unit::class => \App\Policies\UnitPolicy::class, // <-- Thêm dòng này
];
```

Thêm use statement ở đầu file:

```php
use App\Models\Unit;
use App\Policies\UnitPolicy; 
```

## Bước 4: Add route vào routes/api.php

Mở file `routes/api.php` và thêm dòng sau vào trong group middleware auth:api:

```php
Route::middleware('auth:api')->group(function () {
    // ... existing routes
    
    // Unit Module (Training)
    require __DIR__ . '/apis/unit.php'; // <-- Thêm dòng này
});
```

**CHÚ Ý:** Routes đã có middleware `can:unit.view`, `can:unit.create`, etc.

## Bước 5: Chạy Migration

```bash
php artisan migrate
```

Kiểm tra trong database đã có bảng `units` với các cột:
- id (char 10)
- code (varchar 50)
- name (varchar 255)
- status (tinyint)
- note (text)
- created_by, updated_by, deleted_by
- created_at, updated_at, deleted_at

## Bước 6: Chạy Seeder

```bash
php artisan db:seed --class=UnitSeeder
```

Kiểm tra trong database đã có 10 records trong bảng `units`.

## Bước 7: Verify Routes

```bash
php artisan route:list --path=unit
```

Kết quả phải có các routes:
- GET    /api/unit/all-active  → getByStatusActive
- GET    /api/unit/list        → get
- GET    /api/unit/detail/{id} → detail
- POST   /api/unit/create      → create
- POST   /api/unit/update      → update
- DELETE /api/unit/delete/{ids} → delete

## Bước 8: Test APIs với Postman

Import file `POSTMAN_COLLECTION.json` vào Postman để có sẵn các request mẫu.

### 8.1. Get List (có pagination)
```
GET http://localhost:8000/api/unit/list
Authorization: Bearer {token}
```

Query Params (theo convention của project):
- `itemsPerPage`: 10
- `sortBy`: "name"
- `sortDesc`: false
- `status`: 1 (optional)
- `search`: "kg" (optional)

**CHÚ Ý:** Dùng `itemsPerPage` chứ KHÔNG phải `per_page`

### 8.2. Get Active (không pagination)
```
GET http://localhost:8000/api/unit/all-active
Authorization: Bearer {token}
```

### 8.3. Get Detail
```
GET http://localhost:8000/api/unit/detail/{id}
Authorization: Bearer {token}
```

### 8.4. Create
```
POST http://localhost:8000/api/unit/create
Authorization: Bearer {token}
Content-Type: application/json

{
    "code": "TON",
    "name": "Tấn",
    "note": "Đơn vị đo khối lượng lớn",
    "status": 1
}
```

**Validation:**
- code: required, max 50, unique, uppercase
- name: required, max 255
- status: required, in [0,1]
- note: optional, max 1000

### 8.5. Update
```
POST http://localhost:8000/api/unit/update
Authorization: Bearer {token}
Content-Type: application/json

{
    "id": "abc1234567",
    "code": "TON",
    "name": "Tấn (Ton)",
    "note": "Đơn vị đo khối lượng lớn - 1000kg",
    "status": 1
}
```

### 8.6. Delete (soft delete)
```
DELETE http://localhost:8000/api/unit/delete/{ids}
Authorization: Bearer {token}
```

`{ids}` có thể là:
- Single ID: `abc1234567`
- Multiple IDs: `id1,id2,id3` (cách nhau bởi dấu phẩy)

## Troubleshooting

### Lỗi: Target class [App\Repositories\Unit\UnitRepository] does not exist
**Nguyên nhân:** Chưa khai báo DI trong AppServiceProvider

**Giải pháp:**
1. Kiểm tra đã thêm `IUnitRepository::class => UnitRepository::class` vào `$_listRepoMapInterface` chưa
2. Chạy `composer dump-autoload`
3. Chạy `php artisan config:clear`

### Lỗi: Class 'App\Repositories\Base\BaseRepository' not found
**Nguyên nhân:** UnitRepository không tìm thấy BaseRepository

**Giải pháp:**
- Kiểm tra namespace trong UnitRepository.php
- Kiểm tra BaseRepository có tồn tại ở `app/Repositories/Base/BaseRepository.php`

### Lỗi: Call to undefined method getByStatusActive
**Nguyên nhân:** Interface không match với implementation

**Giải pháp:**
- Kiểm tra IUnitRepository interface có khai báo method getByStatusActive() chưa
- Kiểm tra UnitRepository có implement method getByStatusActive() chưa

### Lỗi: Route [unit.viewAny] not defined
**Nguyên nhân:** Policy chưa được register

**Giải pháp:**
1. Kiểm tra đã register Policy trong AuthServiceProvider chưa
2. Clear cache: `php artisan config:clear`

### Lỗi: Base table or view not found: 'units'
**Giải pháp:**
- Chạy lại migration: `php artisan migrate`
- Kiểm tra database connection trong `.env`

### Lỗi: itemsPerPage not working
**Nguyên nhân:** Sử dụng sai parameter name

**Giải pháp:**
- Dùng `itemsPerPage` thay vì `per_page`
- Dùng `sortBy` thay vì `sort_by`
- Dùng `sortDesc` thay vì `sort_order`

## Checklist hoàn thành

### Setup
- [ ] Copy tất cả files vào đúng vị trí
- [ ] Khai báo DI trong AppServiceProvider (**QUAN TRỌNG**)
- [ ] Register Policy trong AuthServiceProvider
- [ ] Add route vào routes/api.php
- [ ] Chạy migration thành công
- [ ] Chạy seeder thành công

### Testing
- [ ] Verify routes: `php artisan route:list --path=unit`
- [ ] Test GET /all-active thành công
- [ ] Test GET /list thành công (với itemsPerPage, sortBy)
- [ ] Test GET /detail/{id} thành công
- [ ] Test POST /create thành công
- [ ] Test POST /update thành công
- [ ] Test DELETE /delete/{ids} thành công (single & multiple)
- [ ] Test validation errors hiển thị đúng
- [ ] Test authorization (middleware can:unit.xxx) hoạt động

### Code Review
- [ ] UnitRepository extends BaseRepository và implements IUnitRepository
- [ ] UnitService extends BaseService và inject IUnitRepository
- [ ] UnitController extends BaseApiController
- [ ] CreateUnitRequest và UpdateUnitRequest extends BaseRequest
- [ ] UnitPolicy extends BasePolicy và set $policyName = 'unit'
- [ ] Method names đúng: get, getByStatusActive, detail, create, update, delete
- [ ] Routes đúng convention: /list, /all-active, /detail/{id}

## Ghi chú quan trọng

### Về Architecture Pattern
1. **Interface → Implementation:**
   - IBaseRepository (base interface)
   - IUnitRepository extends IBaseRepository (custom interface)
   - BaseRepository implements IBaseRepository (base implementation)
   - UnitRepository extends BaseRepository implements IUnitRepository (custom implementation)

2. **Dependency Injection:**
   - PHẢI khai báo trong AppServiceProvider
   - Service inject Interface (IUnitRepository), KHÔNG phải Implementation (UnitRepository)
   - Laravel tự resolve Interface → Implementation

3. **Method Naming:**
   - Dùng get() KHÔNG phải index()
   - Dùng detail() KHÔNG phải show()
   - Dùng create() KHÔNG phải store()
   - Dùng delete() KHÔNG phải destroy()

4. **Pagination Parameters:**
   - itemsPerPage (KHÔNG phải per_page)
   - sortBy (KHÔNG phải sort_by)
   - sortDesc (KHÔNG phải sort_order)

5. **Authorization:**
   - Policy phải được register trong AuthServiceProvider
   - Routes có middleware can:unit.view, can:unit.create, etc.
   - BasePolicy tự động check $user->hasAccess(['unit.view'])

## Tài liệu tham khảo

- BaseRepository: `app/Repositories/Base/BaseRepository.php`
- BaseService: `app/Services/BaseService.php`
- BaseApiController: `app/Http/Controllers/Api/BaseApiController.php`
- BaseRequest: `app/Http/Requests/BaseRequest.php`
- BasePolicy: `app/Policies/Base/BasePolicy.php`
- Example: GroupCustomerRepository, GroupCustomerService, GroupCustomerController

- Code đã follow convention của project hiện tại
- Có thể customize thêm business logic trong Service nếu cần
