<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Trường dữ liệu :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường dữ liệu :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường dữ liệu :attribute phải là một URL hợp lệ.',
    'after' => 'Trường dữ liệu :attribute phải là một ngày sau :date.',
    'after_or_equal' => 'Trường dữ liệu :attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => 'Trường dữ liệu :attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => 'Trường dữ liệu :attribute chỉ được chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường dữ liệu :attribute chỉ được chứa các chữ cái và số.',
    'any_of' => 'Trường dữ liệu :attribute không hợp lệ.',
    'array' => 'Trường dữ liệu :attribute phải là một mảng.',
    'ascii' => 'Trường dữ liệu :attribute chỉ được chứa các ký tự chữ và số một byte và các ký hiệu.',
    'before' => 'Trường dữ liệu :attribute phải là một ngày trước :date.',
    'before_or_equal' => 'Trường dữ liệu :attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'array' => 'Trường dữ liệu :attribute phải có từ :min đến :max phần tử.',
        'file' => 'Trường dữ liệu :attribute phải có kích thước từ :min đến :max kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải có giá trị từ :min đến :max.',
        'string' => 'Trường dữ liệu :attribute phải có độ dài từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường dữ liệu :attribute phải là true hoặc false.',
    'can' => 'Trường dữ liệu :attribute chứa giá trị không được phép.',
    'confirmed' => 'Trường dữ liệu :attribute xác nhận không khớp.',
    'contains' => 'Trường dữ liệu :attribute thiếu một giá trị bắt buộc.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường dữ liệu :attribute phải là một ngày hợp lệ.',
    'date_equals' => 'Trường dữ liệu :attribute phải là một ngày bằng :date.',
    'date_format' => 'Trường dữ liệu :attribute phải khớp với định dạng :format.',
    'decimal' => 'Trường dữ liệu :attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Trường dữ liệu :attribute phải bị từ chối.',
    'declined_if' => 'Trường dữ liệu :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường dữ liệu :attribute và :other phải khác nhau.',
    'digits' => 'Trường dữ liệu :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường dữ liệu :attribute phải có từ :min đến :max chữ số.',
    'dimensions' => 'Trường dữ liệu :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường dữ liệu :attribute có giá trị trùng lặp.',
    'doesnt_contain' => 'Trường dữ liệu :attribute không được chứa bất kỳ giá trị nào sau đây: :values.',
    'doesnt_end_with' => 'Trường dữ liệu :attribute không được kết thúc bằng một trong các giá trị sau: :values.',
    'doesnt_start_with' => 'Trường dữ liệu :attribute không được bắt đầu bằng một trong các giá trị sau: :values.',
    'email' => 'Trường dữ liệu :attribute phải là một địa chỉ email hợp lệ.',
    'encoding' => 'Trường dữ liệu :attribute phải được mã hóa bằng :encoding.',
    'ends_with' => 'Trường dữ liệu :attribute phải kết thúc bằng một trong các giá trị sau: :values.',
    'enum' => 'Giá trị được chọn cho :attribute không hợp lệ.',
    'exists' => 'Giá trị được chọn cho :attribute không hợp lệ.',
    'extensions' => 'Trường dữ liệu :attribute phải có một trong các phần mở rộng sau: :values.',
    'file' => 'Trường dữ liệu :attribute phải là một tệp.',
    'filled' => 'Trường dữ liệu :attribute phải có một giá trị.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'Trường dữ liệu :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải lớn hơn :value.',
        'string' => 'Trường dữ liệu :attribute phải lớn hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Trường dữ liệu :attribute phải có ít nhất :value mục.',
        'file' => 'Trường dữ liệu :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Trường dữ liệu :attribute phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => 'Trường dữ liệu :attribute phải là một màu hex hợp lệ.',
    'image' => 'Trường dữ liệu :attribute phải là một hình ảnh.',
    'in' => 'Giá trị được chọn cho :attribute không hợp lệ.',
    'in_array' => 'Trường dữ liệu :attribute phải tồn tại trong :other.',
    'in_array_keys' => 'Trường dữ liệu :attribute phải chứa ít nhất một trong các khóa sau: :values.',
    'integer' => 'Trường dữ liệu :attribute phải là một số nguyên.',
    'ip' => 'Trường dữ liệu :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường dữ liệu :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường dữ liệu :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường dữ liệu :attribute phải là một chuỗi JSON hợp lệ.',
    'list' => 'Trường dữ liệu :attribute phải là một danh sách.',
    'lowercase' => 'Trường dữ liệu :attribute phải là chữ thường.',
    'lt' => [
        'array' => 'Trường dữ liệu :attribute phải có ít hơn :value mục.',
        'file' => 'Trường dữ liệu :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải nhỏ hơn :value.',
        'string' => 'Trường dữ liệu :attribute phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Trường dữ liệu :attribute không được có nhiều hơn :value mục.',
        'file' => 'Trường dữ liệu :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Trường dữ liệu :attribute phải nhỏ hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường dữ liệu :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường dữ liệu :attribute không được có nhiều hơn :max mục.',
        'file' => 'Trường dữ liệu :attribute không được lớn hơn :max kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute không được lớn hơn :max.',
        'string' => 'Trường dữ liệu :attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường dữ liệu :attribute không được có nhiều hơn :max chữ số.',
    'mimes' => 'Trường dữ liệu :attribute phải là một tệp có định dạng: :values.',
    'mimetypes' => 'Trường dữ liệu :attribute phải là một tệp có định dạng: :values.',
    'min' => [
        'array' => 'Trường dữ liệu :attribute phải có ít nhất :min mục.',
        'file' => 'Trường dữ liệu :attribute phải ít nhất :min kilobytes.',
        'numeric' => 'Trường dữ liệu :attribute phải ít nhất :min.',
        'string' => 'Trường dữ liệu :attribute phải ít nhất :min ký tự.',
    ],
    'min_digits' => 'Trường dữ liệu :attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường dữ liệu :attribute phải bị thiếu.',
    'missing_if' => 'Trường dữ liệu :attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => 'Trường dữ liệu :attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with' => 'Trường dữ liệu :attribute phải bị thiếu khi :values có mặt.',
    'missing_with_all' => 'Trường dữ liệu ',
    'multiple_of' => 'Trường dữ liệu :attribute phải là bội số của :value.',
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng trường dữ liệu :attribute không hợp lệ.',
    'numeric' => 'Trường dữ liệu :attribute phải là một số.',
    'password' => [
        'letters' => 'Trường dữ liệu :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường dữ liệu :attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => 'Trường dữ liệu :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường dữ liệu :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Trường dữ liệu :attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn :attribute khác.',
    ],
    'present' => 'Trường dữ liệu :attribute phải có mặt.',
    'present_if' => 'Trường dữ liệu :attribute phải có mặt khi :other là :value.',
    'present_unless' => 'Trường dữ liệu :attribute phải có mặt trừ khi :other là :value.',
    'present_with' => 'Trường dữ liệu :attribute phải có mặt khi :values có mặt.',
    'present_with_all' => 'Trường dữ liệu :attribute phải có mặt khi :values có mặt.',
    'prohibited' => 'Trường dữ liệu :attribute bị cấm.',
    'prohibited_if' => 'Trường dữ liệu :attribute bị cấm khi :other là :value.',
    'prohibited_if_accepted' => 'Trường dữ liệu :attribute bị cấm khi :other được chấp nhận.',
    'prohibited_if_declined' => 'Trường dữ liệu :attribute bị cấm khi :other bị từ chối.',
    'prohibited_unless' => 'Trường dữ liệu :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường dữ liệu :attribute cấm :other không được có mặt.',
    'regex' => 'Định dạng trường dữ liệu :attribute không hợp lệ.',
    'required' => 'Trường dữ liệu :attribute là bắt buộc.',
    'required_array_keys' => 'Trường dữ liệu :attribute phải chứa các mục cho: :values.',
    'required_if' => 'Trường dữ liệu :attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường dữ liệu :attribute là bắt buộc khi :other được chấp nhận.',
    'required_if_declined' => 'Trường dữ liệu :attribute là bắt buộc khi :other bị từ chối.',
    'required_unless' => 'Trường dữ liệu :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường dữ liệu :attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => 'Trường dữ liệu :attribute là bắt buộc khi :values có mặt.',
    'required_without' => 'Trường dữ liệu :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => 'Trường dữ liệu :attribute là bắt buộc khi không có :values nào có mặt.',
    'same' => 'Trường dữ liệu :attribute phải khớp với :other.',
    'size' => [
        'array' => 'Trường dữ liệu :attribute phải chứa :size mục.',
        'file' => 'Trường dữ liệu :attribute phải có kích thước :size kilobyte.',
        'numeric' => 'Trường dữ liệu :attribute phải là :size.',
        'string' => 'Trường dữ liệu :attribute phải có :size ký tự.',
    ],
    'starts_with' => 'Trường dữ liệu :attribute phải bắt đầu với một trong các giá trị sau: :values.',
    'string' => 'Trường dữ liệu :attribute phải là một chuỗi.',
    'timezone' => 'Trường dữ liệu :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Trường dữ liệu :attribute đã được sử dụng.',
    'uploaded' => 'Trường dữ liệu :attribute không tải lên được.',
    'uppercase' => 'Trường dữ liệu :attribute phải là chữ hoa.',
    'url' => 'Trường dữ liệu :attribute phải là một URL hợp lệ.',
    'ulid' => 'Trường dữ liệu :attribute phải là một ULID hợp lệ.',
    'uuid' => 'Trường dữ liệu :attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'users.*.email' => 'địa chỉ email nhân viên',
    'leave_requests.*.reason' => 'lý do xin nghỉ',
    ],

];
