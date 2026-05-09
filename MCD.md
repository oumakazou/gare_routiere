# MCD (Merise) - Gare Routière

## Text Explanation

This model describes a bus station reservation system.

Entities and attributes:

- **Ville**
  - id
  - nom
  - Relationships:
    - 1 Ville can be the departure for many Voyages.
    - 1 Ville can be the arrival for many Voyages.

- **Societe**
  - id
  - nom
  - contact
  - Relationships:
    - 1 Societe owns many Autocars.

- **Autocar**
  - id
  - matricule
  - capacite
  - type (local, external)
  - societe_id
  - Relationships:
    - 1 Autocar belongs to 1 Societe.
    - 1 Autocar can serve many Voyages.
    - 1 Autocar can have many Equipements (N:M).
    - 1 Autocar can have many Options (N:M).

- **Equipement**
  - id
  - nom
  - Relationships:
    - 1 Equipement can belong to many Autocars (N:M).

- **Option**
  - id
  - nom
  - Relationships:
    - 1 Option can belong to many Autocars (N:M).

- **TypeVoyage**
  - id
  - nom
  - Relationships:
    - 1 TypeVoyage can describe many Voyages.

- **ModeReglement**
  - id
  - nom
  - Relationships:
    - 1 ModeReglement can be used by many Reservations.

- **Voyage**
  - id
  - ville_depart_id
  - ville_arrivee_id
  - autocar_id
  - type_voyage_id
  - date_depart
  - heure_depart
  - heure_arrivee
  - base_price
  - is_special
  - Relationships:
    - 1 Voyage departs from 1 Ville.
    - 1 Voyage arrives at 1 Ville.
    - 1 Voyage uses 1 Autocar.
    - 1 Voyage has 1 TypeVoyage.
    - 1 Voyage can have many Reservations.

- **Reservation**
  - id
  - user_id
  - voyage_id
  - nombre_places
  - seat_numbers
  - mode_reglement_id
  - date_reservation
  - status
  - total_price
  - Relationships:
    - 1 Reservation belongs to 1 User.
    - 1 Reservation belongs to 1 Voyage.
    - 1 Reservation belongs to 1 ModeReglement.

Special logic:

- When `is_special` is true, the final price becomes `base_price * 1.3`.
- The application shows an "Offre spéciale" label for special voyages.

## ASCII Diagram

```
+----------------+        +----------------+        +----------------+        +----------------+
|     Ville      |1      N|     Voyage     |N      1|     Autocar    |1      N|    Societe     |
|----------------|--------|----------------|--------|----------------|--------|----------------|
| id             |        | id             |        | id             |        | id             |
| nom            |        | ville_depart_id|        | matricule      |        | nom            |
+----------------+        | ville_arrivee_id|        | capacite       |        | contact        |
                          | autocar_id     |        | type           |        |                |
                          | type_voyage_id |        | societe_id     |        +----------------+
                          | date_depart    |        +----------------+
                          | heure_depart   |
                          | heure_arrivee  |
                          | base_price     |
                          | is_special     |        +----------------+        +----------------+
                          +----------------+        |  Autocar_      |N      M|   Equipement   |
                                                        | equipements   |--------|----------------|
+----------------+        +----------------+        +----------------+        | id             |
| TypeVoyage     |1      N|  Reservation   |        | Autocar_       |        | nom            |
|----------------|--------|----------------|        | options        |        +----------------+
| id             |        | id             |        |----------------|
| nom            |        | user_id        |        | autocar_id     |        +----------------+
+----------------+        | voyage_id      |        | option_id      |N      M|     Option     |
                          | nombre_places  |        +----------------+--------|----------------|
+----------------+        | seat_numbers   |                                      | id             |
| ModeReglement  |1      N| mode_reglement_id|                                    | nom            |
|----------------|--------| date_reservation|                                    +----------------+
| id             |        | status         |
| nom            |        | total_price    |
+----------------+        +----------------+

+----------------+
|     User       |
|----------------|
| id             |
| name           |
| email          |
| password       |
| is_admin       |
+----------------+
```
