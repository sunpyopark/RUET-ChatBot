node {
    
    environment {
        SLACK_CHANNEL = '#jenkins-ci'
    }	

    env.AWS_ECR_LOGIN=true
    def newApp
    def registry = 'krandmm/subserve-chatbot'
    def version = ':v0.1.'
    def registryCredential = 'docker-hub'
    def awsecrCredential = 'aws-ecr-credentials'
    def awsecrregistry = 'subserve-chatbot'
	
	stage('Git') {
		git 'https://github.com/sunpyopark/RUET-ChatBot/'
	}

	stage('Building image') {
        docker.withRegistry('https://registry.hub.docker.com', registryCredential) {
		    def buildName = registry + version + "$BUILD_NUMBER"
			newApp = docker.build buildName
			newApp.push()
        }
	}
	
	stage('Building Docker image For AWS ECR') {
        docker.withRegistry('https://630561942235.dkr.ecr.us-west-1.amazonaws.com/subserve-chat', 'ecr:us-west-1:aws-ecr-credentials') {
	   def buildName = awsecrregistry + version + "$BUILD_NUMBER"
		newApp = docker.build buildName
		newApp.push()
        }
        }

	
	stage('Registring image') {
        docker.withRegistry('https://registry.hub.docker.com', registryCredential) {
    		newApp.push 'latest'
        }
	}
        stage('Removing image') {
            sh "docker rmi $registry:$BUILD_NUMBER --force"
            sh "docker rmi $registry:latest --force"
        }
	stage("Slack speak") {
        slackSend color: '#BADA55', message: 'Hello, World!'
        }
}
