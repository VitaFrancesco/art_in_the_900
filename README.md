<p align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg" width="100" alt="React Logo" />
</p>

<h1 align="center">Arte '900 – Frontoffice</h1>

<p align="center">
  Progetto frontend sviluppato in React, parte del progetto finale della specializzazione PHP/Laravel di Boolean.
</p>

---

## 📚 Descrizione

Questo progetto rappresenta il **lato frontoffice** del sito dedicato all'arte del '900. L'interfaccia utente è realizzata in **React** e comunica con il progetto **backoffice in Laravel** tramite chiamate API effettuate con **Axios**.

L’obiettivo è offrire una navigazione semplice e intuitiva, con contenuti accessibili e collegati tra loro.

---

## 🖼️ Funzionalità principali

- **Homepage** introduttiva che presenta i contenuti principali del sito.
- **Navigazione semplice** con link chiari per esplorare:
  - Artisti
  - Opere
  - Movimenti artistici del '900
- **Visualizzazione dinamica** delle entità tramite chiamate API al backend Laravel.
- **Paginazione dinamica** per una migliore gestione dei risultati.
- **Filtri avanzati** per facilitare la ricerca.
- **Pagine di dettaglio** per ogni entità:
  - Gli artisti mostrano le opere tramite carosello.
  - I movimenti artistici sono collegati agli artisti appartenenti.
  - Le opere includono informazioni e collegamenti relativi.

---

## 🔗 Tecnologie utilizzate

- [React](https://reactjs.org/)
- [Axios](https://axios-http.com/)
- [React Router](https://reactrouter.com/)
- [Bootstrap](https://getbootstrap.com/)
- Backend: [Laravel 10+](https://laravel.com) tramite API REST

---

## 🚀 Avvio del progetto

```bash
# Clona il repository
git clone https://github.com/tuo-username/nome-repo.git
cd nome-repo

# Installa le dipendenze
npm install

# Avvia il server di sviluppo
npm run dev
