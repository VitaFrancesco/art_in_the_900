<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel Logo">
</p>

<h1 align="center">Arte '900 – Backoffice</h1>

<p align="center">
  Backend realizzato in Laravel per la gestione tramite pannello amministrativo delle entità relative all’arte del '900.
</p>

---

## 🧠 Descrizione

Questo progetto costituisce il **lato backoffice** del progetto finale della specializzazione PHP/Laravel di Boolean.  
Sviluppato con **Laravel**, espone un set di **API RESTful** consumate dal frontend (realizzato in React) e fornisce anche una **dashboard protetta da login** per amministratori.

---

## ⚙️ Funzionalità principali

- **Database relazionale** gestito tramite:
  - **Migrazioni** per definire la struttura
  - **Seeder** per popolare dati di test
  - **Model Eloquent** per la gestione delle entità e delle relazioni
- **CRUD completo** per tutte le entità (Artisti, Opere, Movimenti)
- **Upload immagini** con salvataggio in storage e visualizzazione lato admin
- **Rotte web protette** da autenticazione
- **Dashboard amministrativa** con:
  - Elenco entità paginato e filtrabile
  - Form di creazione con gestione immagini e relazioni
  - Pagina di dettaglio per modificare o eliminare (con conferma via modale)
- **Gestione relazioni** tra entità:
  - **Checkbox** per relazioni many-to-many
  - **Select** per relazioni one-to-many

---

## 🛡️ Autenticazione con Breeze

L’accesso all’area amministrativa è protetto tramite **Laravel Breeze**, un pacchetto leggero per l'autenticazione che fornisce login, registrazione, e gestione utenti con layout Blade e middleware `auth`.

> Solo gli utenti autenticati possono accedere al backoffice.

---

## 🧩 Tecnologie utilizzate

- [Laravel 10](https://laravel.com/)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade](https://laravel.com/docs/blade)
- [Axios](https://axios-http.com) (consumato dal frontend)
- [MySQL](https://www.mysql.com/) come database relazionale

---

## 📦 Installazione progetto

```bash
# Clona il repository
git clone https://github.com/tuo-username/arte900-backoffice.git
cd arte900-backoffice

# Installa le dipendenze PHP
composer install

# Installa Breeze
php artisan breeze:install
npm install && npm run dev

# Configura .env
cp .env.example .env
php artisan key:generate

# Configura DB nel .env

# Esegui migrazioni e seeder
php artisan migrate --seed

# Avvia il server
php artisan serve