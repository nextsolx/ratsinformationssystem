## Frontend workflow
### live server, generate app.js and app.css
./devops yarn prod
### local server
./devops yarn dev
### lint js
./devops yarn lint
### lint styles
./devops yarn style-lint
### setup to local env
1) copy .env.example to .env
2) ./devops artisan key:generate
3) ./devops install
4) ./devops setup
5) ./devops up -d 
6) generate demo data: ./devops crawl:all

x) add the db management. Add to 
'docker-compose.override.yml' into node 'services':
<pre> 
 adminer:
    image: adminer
    restart: always
    ports:
      - 8080:8080
</pre>
DB credential see in .env -> Database

## Design inVision
https://projects.invisionapp.com/d/?origin=v7#/projects/prototypes/17867080

## Design .sketch
https://convideracom.sharepoint.com/sites/NetsolX/Freigegebene%20Dokumente/Forms/AllItems.aspx?id=%2Fsites%2FNetsolX%2FFreigegebene%20Dokumente%2FGeneral%2FProjekte%2FStadt%20K%C3%B6ln%2FScreens%2F04%20%2D%20Situngsseite%2Esketch&parent=%2Fsites%2FNetsolX%2FFreigegebene%20Dokumente%2FGeneral%2FProjekte%2FStadt%20K%C3%B6ln%2FScreens&p=true

## Stage/QA server
http://project-ris.nextsolx.team

pass: 4711
