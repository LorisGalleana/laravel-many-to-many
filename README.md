# LARAVEL MANY TO MANY - Gestione Tecnologie Utilizzate nei Progetti

## Descrizione

**Laravel Many to Many** è un'applicazione sviluppata con **Laravel 10** per gestire i progetti e le tecnologie utilizzate. Ogni progetto può essere associato a più tecnologie e viceversa, creando una relazione **many to many** tra i progetti e le tecnologie. L'applicazione permette agli utenti di visualizzare e gestire le tecnologie utilizzate nei progetti, oltre a consentire l'associazione delle tecnologie tramite un'interfaccia utente.

## Funzionalità

- **Gestione Tecnologie**:
  - Ogni progetto può essere associato a più tecnologie.
  - Ogni tecnologia può essere utilizzata da più progetti.
  - CRUD completo per le tecnologie tramite un pannello di amministrazione.

- **Relazione Many to Many**:
  - I progetti possono essere associati a molte tecnologie.
  - Le tecnologie possono essere utilizzate in molti progetti.
  - La tabella pivot `project_technology` gestisce la relazione tra i progetti e le tecnologie.

- **Creazione e Modifica dei Progetti**:
  - Durante la creazione e modifica di un progetto, è possibile associare una o più tecnologie al progetto.

- **Visualizzazione Tecnologie nel Dettaglio del Progetto**:
  - Ogni progetto mostra le tecnologie utilizzate nella pagina di dettaglio.

## Tecnologie Utilizzate

- **Laravel 10**: Framework PHP per la gestione del backend.
- **Eloquent ORM**: Per la gestione delle relazioni tra modelli.
- **Blade**: Motore di templating per la gestione delle view.
- **PHP**: Linguaggio di programmazione per il backend.
- **MySQL**: Database per la memorizzazione dei dati.

