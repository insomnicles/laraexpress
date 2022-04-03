

## Laraexpress

A simple way of handling expressions, reactions and ratings in Laravel.

## Features

- Expressions
    - Numerous Expression types with discrete or gradient ranges
    - Expressable models (models that can have expressions) are predefined
    - Expressable Models can have multiple expression types (e.g. can express like  and 3-star rating for an Image Model)
    - One user expression per expressable model and expression type; Users can have multiple expression for an expressable model (e.g. like and 3 star rating for image)
    - Storing an existing expression for a model and type overwrites it

    - Only authenticated users can store expressions
    - Users can only update or delete their own expressions
    - Users can only have expressions to predefined set of expressable models


- Built in types
    - Applause
    - Like/Dislike
    - Hot - Cold discrete
    - Hot - Cold gradient
    - Voting
    - ELO Chess Rating

## Usage
- Facade Calls

```
    $expression = Express::express($image, config(express.kinds.fivestar), config(express.expression.fivestars));
    $expression = Express::express($movie, Express::FIVESTAR, Express::FIVESTARS);
    $expression = Express::express($restaurant, Express::MICHELINSTAR, Express::ONEMICHELINSTARS);
    $expression = Express::express($image, Express::LIKEDISLIKE, Express::LIKE);
    $expression = Express::express($image, Express::HOTCOLDGRADIENT, 2.563);
    $expression = Express::express($image, Express::EMOTIVE, Express::HAPPY);
    $expression = Express::express($image, Express::EMOTIVE, Express::MAD);
    $expression = Express::express($image, Express::COGNITIVE, Express::CONFUSING);
    $expression = Express::express($image, Express::COGNITIVE, Express::INTERESTING);
    $expression = Express::express($chessPlayer, Express::ELO, Express::GRANDMASTER);
    $expression = Express::express($chessPlayer, Express::ELO, 2832);
    $expression = Express::express($bill, Express::VOTE, Express::INFAVOR);
```

- Adding Expressable Models and Types
    1. If necessary, add custom type: add record to expression_types table or to seeder
    2. Add record to ExpressableModel: one for each type and expressable model pair
    3. Add class constants for desired preset values to App\Expression\Expression.php
    4. use as above

## Examples of Definition of Custom Types

- Michelin Stars
    - range_type: int
    - min: 1
    - max: 3
    - names: [ 1 => '1 Michelin Star', 2 => '2 Michelin Stars', 3 => '3 Michelin Stars' ]
    - icons: [ 1 => '1-star.png', 2 => '2-stars.png', 3 => '3-stars.png' ]

- Voting
    - range_type: int
    - min: 1
    - max: 2
    - names: [ 1 => 'In Favor', 2 => 'Against' ]
    - icons: null

- Hot-Cold
    - range_type: float
    - min: 1
    - max: 5
    - names: [ 1 => 'Freezing', 2 => 'Cold', 3 => 'Medium', 4 => 'Warm', 5 => 'Hot' ]
    - icons: [ 1 => 'freezing.png', 5 => 'hot.png' ]

## Design Choices
- Independence from rest of Laravel Application; [complete independence???]
    - i) no interaction with eloquent [facade call only]
    - ii) Use
        - If app is part of standalone Laravel project, use one Facade call only
        - If app is microservice, use rest routes only
    - PRO:
        - adding, removing, updating expressions is simpler in basic crud cases
        - updates / changes to expression versions can't affect rest of app
        - can create independent expressions microservice in architectures with different languages and frameworks
        - Integration with Relational or NoSQL Databases simple
        - Use of NoSQL DBS is simple; no changes to Facade
    - CON: can't integrate with eloquent models and queries
        - makes existing complex Eloquent queries in app a two/three-step process


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
