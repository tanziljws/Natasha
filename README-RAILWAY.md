# Railway Deployment Guide

## Import Database ke Railway MySQL

### Opsi 1: Import via Railway Dashboard (Terminal)

1. Buka Railway Dashboard → MySQL Service → **Connect**
2. Klik "Open in Terminal" atau gunakan Railway CLI
3. Upload file `cl1kn4.sql` ke Railway
4. Import dengan command:
   ```bash
   mysql -h $MYSQL_HOST -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE < cl1kn4.sql
   ```

### Opsi 2: Import via Script PHP (Recommended)

1. Pastikan file `cl1kn4.sql` ada di root project atau di `../cl1kn4.sql`
2. Set environment variables di Railway Dashboard:
   - `DB_HOST` = (dari MySQL service connection)
   - `DB_PORT` = (dari MySQL service connection)
   - `DB_DATABASE` = `railway` atau nama database yang diinginkan
   - `DB_USERNAME` = (dari MySQL service)
   - `DB_PASSWORD` = (dari MySQL service)

3. Jalankan script import:
   ```bash
   php database/import-railway.php
   ```

### Opsi 3: Import via Railway MySQL Service Variables

Railway MySQL service otomatis menyediakan environment variables:
- `MYSQL_HOST`
- `MYSQL_PORT`
- `MYSQLUSER`
- `MYSQLPASSWORD`
- `MYSQLDATABASE`

Script `database/import-railway.php` akan otomatis menggunakan variables ini jika tersedia.

### Opsi 4: Import via External MySQL Client

Jika Anda punya akses MySQL client:

```bash
mysql -h trolley.proxy.rlwy.net -u root -pXVCsfIMalQZPutvibBHNBkToOiUajrWv --port 51434 --protocol=TCP railway < cl1kn4.sql
```

## Setup Environment Variables di Railway

### Untuk Laravel Service:

1. Buka Railway Dashboard → **Natasha** Service → **Variables**
2. Tambahkan variables berikut:

```
APP_NAME=Website
APP_ENV=production
APP_KEY=base64:vzK52KnLarA+uXrlAb8XDpQUB+QrSHZzFNdU3EGZHes=
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

**Catatan:** `${{MySQL.XXX}}` adalah reference ke MySQL service variables di Railway.

## Troubleshooting

### Database masih kosong?

1. Pastikan MySQL service sudah running
2. Cek connection string di Railway MySQL service → **Connect**
3. Pastikan environment variables sudah di-set dengan benar
4. Jalankan script import: `php database/import-railway.php`

### Error: "Table doesn't exist"

Pastikan database sudah di-import dengan benar. Jalankan script import lagi.

### Error: "Access denied"

Cek credentials di Railway MySQL service → **Variables** atau **Connect** tab.

