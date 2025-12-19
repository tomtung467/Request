# TRAINING MODULE UNIT - SUMMARY

## Module này để làm gì?

Module training **ĐƠN GIẢN** để học **ĐÚNG CONVENTION** của project.

**Mục tiêu:** Học cách viết code Laravel Backend theo chuẩn của project, không phải theo tutorial bên ngoài.

---

## 🎯 Điểm khác biệt với Tutorial Laravel thông thường

### ❌ KHÔNG dùng REST naming
- ~~index()~~ → Dùng **get()**
- ~~show()~~ → Dùng **detail()**
- ~~store()~~ → Dùng **create()**
- ~~destroy()~~ → Dùng **delete()**

### ❌ KHÔNG dùng pagination Laravel standard
- ~~per_page~~ → Dùng **itemsPerPage**
- ~~sort_by~~ → Dùng **sortBy**
- ~~sort_order~~ → Dùng **sortDesc**

### ✅ BẮT BUỘC dùng Interface
- Repository PHẢI implement Interface: `IUnitRepository extends IBaseRepository`
- Service inject Interface, KHÔNG inject class: `__construct(IUnitRepository $repo)`

### ✅ BẮT BUỘC extends Base classes
- Repository extends **BaseRepository**
- Service extends **BaseService**
- Controller extends **BaseApiController**
- Request extends **BaseRequest**
- Policy extends **BasePolicy**

### ✅ BẮT BUỘC khai báo DI
- Phải thêm vào **AppServiceProvider**: `IUnitRepository::class => UnitRepository::class`
- Nếu không khai báo → Error: Target class does not exist

---

## 📁 File Structure (8 files chính)

```
1. IUnitRepository.php        → Interface (3 methods: getByStatusActive, get, delete)
2. UnitRepository.php          → Extends BaseRepository, implements IUnitRepository
3. UnitService.php             → Extends BaseService, inject IUnitRepository
4. UnitController.php          → Extends BaseApiController, inject UnitService
5. CreateUnitRequest.php       → Extends BaseRequest
6. UpdateUnitRequest.php       → Extends BaseRequest
7. UnitPolicy.php              → Extends BasePolicy, $policyName = 'unit'
8. UnitFilter.php              → Extends AbstractFilter (cho search & status)
```

**Bonus:**
- Migration: `create_units_table.php`
- Seeder: `UnitSeeder.php` (10 records)
- Model: `Unit.php`
- Routes: `unit.php`

---

## 🔥 Top 5 lỗi thường gặp

### 1. Target class [UnitRepository] does not exist
**Nguyên nhân:** Chưa khai báo DI trong AppServiceProvider

**Fix:**
```php
// app/Providers/AppServiceProvider.php
protected $_listRepoMapInterface = [
    IUnitRepository::class => UnitRepository::class,
];
```

### 2. Call to undefined method getByStatusActive
**Nguyên nhân:** Interface không có method này

**Fix:** Thêm vào IUnitRepository.php
```php
public function getByStatusActive();
```

### 3. itemsPerPage not working
**Nguyên nhân:** Dùng sai parameter `per_page`

**Fix:** Dùng `itemsPerPage`, `sortBy`, `sortDesc`

### 4. Route [unit.view] not defined
**Nguyên nhân:** Chưa register Policy

**Fix:**
```php
// app/Providers/AuthServiceProvider.php
protected $policies = [
    Unit::class => UnitPolicy::class,
];
```

### 5. Validation error format sai
**Nguyên nhân:** Dùng FormRequest thay vì BaseRequest

**Fix:** Extends BaseRequest
```php
class CreateUnitRequest extends BaseRequest
```

---

## 🎓 Bài học từ Module này

### 1. Architecture Flow
```
Request → Controller → Service → Repository → Database
         ↓            ↓          ↓
      BaseApi     BaseService  BaseRepository
      Controller                   ↓
         ↓                    IBaseRepository
      Policy                  (Interface)
```

### 2. Dependency Injection
- Service inject **Interface** (IUnitRepository), không inject **Class** (UnitRepository)
- Laravel tự resolve Interface → Implementation nhờ AppServiceProvider
- Lợi ích: Dễ test, dễ thay đổi implementation

### 3. Method Naming
- Project có convention riêng, KHÔNG follow REST
- Phải xem source code thật để học (GroupCustomerController, BrandService, etc.)

### 4. Pagination Convention
- `itemsPerPage` thay vì `per_page`
- `sortBy` thay vì `sort_by`
- `sortDesc` (boolean) thay vì `sort_order` (string)

### 5. Authorization
- Policy xử lý authorization
- Middleware `can:unit.view`, `can:unit.create`
- BasePolicy tự động check `$user->hasAccess(['unit.view'])`

---

## ✅ Checklist khi implement module mới

### Tạo files
- [ ] IXxxRepository interface (extends IBaseRepository)
- [ ] XxxRepository (extends BaseRepository, implements IXxxRepository)
- [ ] XxxService (extends BaseService, inject IXxxRepository)
- [ ] XxxController (extends BaseApiController, inject XxxService)
- [ ] CreateXxxRequest (extends BaseRequest)
- [ ] UpdateXxxRequest (extends BaseRequest)
- [ ] XxxPolicy (extends BasePolicy)
- [ ] XxxFilter (extends AbstractFilter)

### Setup DI & Authorization
- [ ] Khai báo DI trong AppServiceProvider
- [ ] Register Policy trong AuthServiceProvider
- [ ] Add routes với middleware can:

### Method naming
- [ ] get() - Danh sách có pagination
- [ ] getByStatusActive() - Danh sách active
- [ ] detail($id) - Chi tiết
- [ ] create($data) - Tạo mới
- [ ] update($data) - Cập nhật
- [ ] delete($ids) - Xóa

### Testing
- [ ] Test pagination với itemsPerPage, sortBy, sortDesc
- [ ] Test filter với status, search
- [ ] Test validation errors
- [ ] Test authorization (can:)

---

## 📚 Đọc thêm

**Source code tham khảo trong project:**
- GroupCustomerRepository, GroupCustomerService, GroupCustomerController
- BrandRepository, BrandService, BrandController
- UnitRepository, UnitService, UnitController (trong app chính, không phải training)

**Base classes:**
- `app/Repositories/Base/IBaseRepository.php`
- `app/Repositories/Base/BaseRepository.php`
- `app/Services/BaseService.php`
- `app/Http/Controllers/Api/BaseApiController.php`
- `app/Http/Requests/BaseRequest.php`
- `app/Policies/Base/BasePolicy.php`

---

## 🚀 Next Steps

1. **Copy module vào project** (xem INSTALLATION.md)
2. **Đọc code từng file** để hiểu flow
3. **Test APIs** với Postman
4. **Thử tạo module khác** theo pattern này (VD: Category, Brand, etc.)
5. **Hỏi lead** nếu có điểm nào chưa rõ về convention

**Happy Learning!** 🎉
