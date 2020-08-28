# ahead-generators
A collection of CRUD generators for Lumen by A-Host

# How-To-Use

### วิธี Generate Model, Resource, Repository, Controller, Route ในคำสั่งเดียว

#### Command

```
php artisan ahead:start <your resource name in PascalCase or camelCase>
```


### วิธี Generate Model

#### คำอธิบายการใช้ Flag

| Flag      | Description |
| ----------- | ----------- |
| --table      | ชื่อ Table ตาม Database       |
| --fillable   | กำหนดคอลัมน์ fillable ตัวอย่างการใส่ เช่น col1,col2,col3,...        |
| --timestamps   | กำหนด Timestamp โดยค่า Default เป็น true        |
| --path   | กำหนด Path เก็บ Model โดยค่า Default เป็น app/Models        |
| --force   | กรณีที่มีไฟล์ชื่อนั้นอยู่แล้ว ต้องการให้เขียนทับไฟล์เดิม ให้ส่ง flag --force=true        |

#### Command

```
php artisan ahead:model <your model name> --<flagname>=<value>
```


### วิธี Generate Resource

#### คำอธิบายการใช้ Flag

| Flag      | Description |
| ----------- | ----------- |
| --table      | ชื่อ Table ตาม Database       |
| --path   | กำหนด Path เก็บ Resources โดยค่า Default เป็น app/Resources        |
| --force   | กรณีที่มีไฟล์ชื่อนั้นอยู่แล้ว ต้องการให้เขียนทับไฟล์เดิม ให้ส่ง flag --force=true        |

#### Command

```
php artisan ahead:rsc <your resource name> --<flagname>=<value>
```


### วิธี Generate Repository

#### คำอธิบายการใช้ Flag

| Flag      | Description |
| ----------- | ----------- |
| --model      | กำหนดชื่อ Model กรณีที่มี Model อยู่แล้ว       |
| --path   | กำหนด Path เก็บ Repositories โดยค่า Default เป็น app/Repositories        |
| --force   | กรณีที่มีไฟล์ชื่อนั้นอยู่แล้ว ต้องการให้เขียนทับไฟล์เดิม ให้ส่ง flag --force=true        |

#### Command

```
php artisan ahead:repo <your repository name> --<flagname>=<value>
```


### วิธี Generate Controller

#### คำอธิบายการใช้ Flag

| Flag      | Description |
| ----------- | ----------- |
| --model      | กำหนดชื่อ Model กรณีที่มี Model อยู่แล้ว       |
| --resource      | กำหนดชื่อ Resource กรณีที่มี Resource อยู่แล้ว       |
| --repository      | กำหนดชื่อ Repository กรณีที่มี Repository อยู่แล้ว       |
| --path   | กำหนด Path เก็บ Controller โดยค่า Default เป็น app/Http/Controllers        |
| --force   | กรณีที่มีไฟล์ชื่อนั้นอยู่แล้ว ต้องการให้เขียนทับไฟล์เดิม ให้ส่ง flag --force=true        |

#### Command

```
php artisan ahead:ctrl <your controller name> --<flagname>=<value>
```


### วิธี Generate Route

#### คำอธิบายการใช้ Flag

| Flag      | Description |
| ----------- | ----------- |
| --controller     | กำหนดชื่อ Controller กรณีที่มี Controller อยู่แล้ว       |
| --laravel      | กำหนด Pattern ของ Route กรณีที่ใช้กับ Project ที่เป็น laravel route จะถูก generate ที่ routes/api.php ถ้าไม่ใช่ default จะเป็น routes/web.php ตัวอย่างการส่ง flag --laravel=true     |

#### Command

```
php artisan ahead:route <your route name> --<flagname>=<value>
```
