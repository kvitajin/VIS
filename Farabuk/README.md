# Farabuk
## Informační systém pro farnosti 
 
 
Celý projekt vzikl za účelem umožnit každé farnosti mít vlastní farní stránky bez většího problému. 
- Samotný projekt má několik základních složek, proto popíšu, o se v které zhuba nachází, aby byla orientace zjednodušena </br>
---
- #  frontend
    - zatím prázdné
--- 

- # server
    - common 
        - pomocné třídy, které mají spíše podpůrnou funkci
    - db 
        - zdojový kód starající se o vytvoření databáze 
    - src  
         - stará se o nejnižší vrstvu programu => ORM 
         - data 
            - datové classy všech tabulek, včetně těch vazebních
            - občas obsahují i sktruktury, které nejsou přímo v databázi, ale jsou potřeba pro učité funkce (pole "podřízených" objektů)
    - repository 
        - třídy metod a intervacy 
    - static 
        - zatím prázdné, zamýšleno jako složka harcodovaných věcí, u kterých se počítá s brzkou úpravou 
    
