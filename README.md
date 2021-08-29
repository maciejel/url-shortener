# The simplest URL shortener ever
## Installation

**1.** Execute this SQL statement

```sql
CREATE TABLE `redirects` (
  `id` int(11) NOT NULL,
  `link` longtext NOT NULL,
  `custom_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `redirects`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `redirects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
```

**2.** Configure the `config.example.php` file, then rename it to `config.php`
## License
Use this code where you want