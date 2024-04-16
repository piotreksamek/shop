# SHOP

SHOP to aplikacja internetowa, która umożliwia użytkownikom przeglądanie produktów. Projekt jest podzielony na dwie główne części:

- **Panel administracyjny**: Dedykowany interfejs dla administratorów sklepu, umożliwiający zarządzanie produktami i kategoriami w przyszłości również zamówieniami i klientami. Administratorzy mogą dodawać, edytować i usuwać produkty.
  
- **Frontend aplikacji**: Widok dostępny dla klientów, gdzie mogą przeglądać produkty.

## Przygotowanie projektu
Mamy możliwość zmiany portów w pliku docker-compose.override.yml na własne i następnie:
```
docker compose build
```

```
docker compose up -d
```

```
docker compose exec -it shop-php bash
cd shop_backend
php bin/console doctrine:migrations:migrate
php bin/console ca:cl
```

```
docker compose exec -it shop-vue-app bash
npm install
npm run build
```

## Struktura

- **Application**: W tej części znajdują się pliki odpowiedzialne za implementację logiki biznesowej aplikacji.

- **Data**: Tutaj umieszczone są encje, enumeratory oraz embeddable klasy.

- **Infrastructure**: Tutaj umieszczone są integracje zewnętrzne, rozszerzenia frameworków itp.

- **UI**: W tej części znajdują się kontrolery, formularze oraz inne elementy związane z interfejsem użytkownika.
