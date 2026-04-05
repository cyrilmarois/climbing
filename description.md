# SendIt

Application web de suivi d'escalade conçue pour les clubs et les grimpeurs. SendIt permet aux salles d'escalade de gérer leurs voies et événements, et aux grimpeurs de suivre leur progression, noter les voies et participer à la vie de leur communauté.

## Cible

- **Clubs / salles d'escalade** — Créent et gèrent leurs voies (bloc, voie, vitesse), organisent des compétitions et événements, suivent l'activité de leurs membres.
- **Grimpeurs** — Enregistrent leurs ascensions, suivent leur progression par cotation, rejoignent des clubs, participent à des événements et échangent via les commentaires.

## Concepts métier

| Concept | Description |
|---------|-------------|
| **Club** | Salle d'escalade ou site extérieur, géolocalisé, rattaché à un pays |
| **Route** | Voie ou bloc au sein d'un club, avec cotation, couleur, type (bloc/voie/vitesse), ligne et ordre |
| **Grade** | Cotation de difficulté multi-système (français, Yosemite, UIAA) |
| **Color** | Couleur de prise identifiant visuellement une voie |
| **Tag** | Caractéristique d'une voie (style, type de prise, mouvement, sensation) — 25+ tags spécialisés |
| **Route Record** | Ascension enregistrée par un grimpeur : nombre d'essais, note (1-5), cotation personnelle |
| **Event** | Compétition ou rassemblement avec discipline, division et classement |
| **Event Record** | Participation d'un grimpeur à un événement avec score et classement |
| **Route Comment** | Commentaire sur une voie avec système de réponses imbriquées |
| **User Profile** | Profil grimpeur (nom, taille, poids, date de naissance, pays, avatar) lié au compte utilisateur |
| **Social Account** | Connexion OAuth (Google, GitHub, Facebook, Twitter, Apple) |

## Fonctionnalités existantes

- **Authentification** — Inscription par email, connexion OAuth multi-provider, vérification email, 2FA, réinitialisation de mot de passe
- **Profil grimpeur** — Informations personnelles, avatar (social/upload/défaut), rattachement pays
- **Clubs** — Création, adhésion des grimpeurs avec date d'inscription, géolocalisation
- **Voies** — Gestion complète (nom, cotation, couleur, type, ligne, ouverture/fermeture), tagging multi-critères
- **Ascensions** — Enregistrement des tentatives avec nombre d'essais, note et cotation personnelle
- **Événements** — Compétitions par discipline avec classement et scores
- **Commentaires** — Discussions sur les voies avec réponses imbriquées

## Vision future

### Gamification
- Badges et récompenses (premier 7a, 100 blocs, etc.)
- Système de niveaux basé sur l'activité et la progression
- Défis hebdomadaires/mensuels entre grimpeurs
- Classements par club, par région, par cotation

### Social
- Feed d'activité (ascensions récentes, badges débloqués)
- Suivre d'autres grimpeurs et voir leur progression
- Partage de performances et de sessions
- Notifications d'activité

### Analytics et statistiques
- Tableaux de bord de progression personnelle
- Graphiques d'évolution par cotation et par type
- Statistiques par club (voies les plus tentées, taux de réussite)
- Prédictions de niveau basées sur l'historique

## Stack technique

- **Backend** — PHP 8.5, Laravel 12, Fortify (auth), Socialite (OAuth), Wayfinder (routes TS)
- **Frontend** — Vue 3, Inertia.js v2, Tailwind CSS v4, TypeScript
- **Base de données** — MySQL
- **Infra** — Docker via Laravel Sail
- **Qualité** — Pest v4 (tests), Larastan (analyse statique), Pint (formatage), Rector (refactoring)
- **Architecture** — Pattern Action pour la logique métier, Form Requests pour la validation, Factories pour les données de test
