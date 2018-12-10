#include<stdio.h>
#include<stdlib.h>
#include<conio.h>
#define NUMBER_OF_PROCESS 5
#define NUMBER_OF_RESOURCE 3
int Available[NUMBER_OF_RESOURCE]={10,5,7};
int Allocation[NUMBER_OF_PROCESS][NUMBER_OF_RESOURCE]={{0,1,0},{2,0,0},{3,0,2},{2,1,1},{0,0,2}};
int Need[NUMBER_OF_PROCESS][NUMBER_OF_RESOURCE]={0};
int Max[NUMBER_OF_PROCESS][NUMBER_OF_RESOURCE]={{7,5,3},{3,2,2},{9,0,2},{2,2,2},{4,3,3}};
int SafeSequence[NUMBER_OF_PROCESS]={-1,-1,-1,-1,-1};
int Done[NUMBER_OF_PROCESS]={-1,-1,-1,-1,-1};



int PrintfSafeSequence(){
	
	for(int i =0;i < NUMBER_OF_PROCESS;i++){
		printf("%d",SafeSequence[i]);
		if(i<NUMBER_OF_PROCESS - 1)
			printf(",");
	}
	printf(">");
}
int Safety(){
	int findflag=0;
	int Work[NUMBER_OF_RESOURCE];
	
	for(int i=0;i<NUMBER_OF_RESOURCE;i++)
		Work[i] = Available[i];
	for(int j=0;j <NUMBER_OF_PROCESS;j++){
		Done[j]= -1;
		SafeSequence[j]= -1;
	}
	for (int index=0;index < NUMBER_OF_PROCESS;index++){
		findflag=0;
		for(int i=0; i < NUMBER_OF_PROCESS;i++){
			if(Done[i] == 1)
				continue;
			findflag=0;
			for(int j=0; j <NUMBER_OF_RESOURCE;j++){
				if(Work[j]<Need[i][j]){
					findflag=-1;
					break;
				}
			}
			if(findflag == -1)
				continue;
			
			findflag=1;
			Done[i]=1;
			for(int j=0; j < NUMBER_OF_RESOURCE;j++)
					Work[j] +=Allocation[i][j];
				SafeSequence[index]=i;
			break;
		}
			if (findflag != 1)
				break;
		}
	findflag =0;
	for(int i =0;i < NUMBER_OF_PROCESS;i++){
		if(Done[i]==-1){
			printf("\n Process %d not done!",i);
			findflag = -1;
		}
	}
	if(findflag == -1){
		printf("\n Unsafe");
	} else {
		printf("\n Safe! Find safe sequence:");
		PrintfSafeSequence();
	}
	return findflag;
}


int PrintSystemSnapshot(){
	printf("\n Available resource: ");
	for(int i=0;i <NUMBER_OF_RESOURCE;i++)
		printf("%d",Available[i]);
	printf("\n");
	printf("Resource Allocation | Max request | Remaining Need:\n");
	for(int i=0;i<NUMBER_OF_PROCESS;i++){
		printf("Process #%d ",i);
		
		for(int j=0;j<NUMBER_OF_RESOURCE;j++){
			printf("%d",Allocation[i][j]);
		}
		
		for(int j=0;j<NUMBER_OF_RESOURCE;j++){
			printf("%d",Max[i][j]);
	}
	
		for(int j =0;j <NUMBER_OF_RESOURCE;j++){
			printf("%d",Need[i][j]);
	}
		printf("\n");	
		
	
	}	

}
int initialize(){
	int i=0;
	for ( i= 0; i<NUMBER_OF_PROCESS;i++);
		for(int j= 0;j <NUMBER_OF_RESOURCE;j++){
			Available[j] -= Allocation[i][j];
			Need[i][j] = Max[i][j] - Allocation[i][j];
		}
	printf("\n initialize system states:");
	PrintSystemSnapshot();
}
int main(){
	int p_no;
	char contiue_flag;
	int request[NUMBER_OF_RESOURCE];
	initialize();
	if(Safety()== -1)
		return 0;
	printf("\n Banker's algorithm starts!\n");
	//printf("\n\n Resource-request algortithm starts!\n");
	do{
		PrintSystemSnapshot();
		printf("\n request!Enter process no:");
		scanf("%d",&p_no);
		for(int j=0;j<NUMBER_OF_RESOURCE;j++){
			printf("\n Enter request resource #%d=",j);
			scanf("%d",&request[j]);
		}
		for(int j=0;j< NUMBER_OF_RESOURCE;j++){
			if(request[j]>Available[j]){
			printf("\n request > Available!Process must wait ");
			goto L1;
		}
		if(request[j] > Need[p_no][j]){
			printf("\n request > Need! error!");
			goto Exit;
		}
	}
	printf("\n Pretend to grant the request");
	for(int i=0; i<NUMBER_OF_RESOURCE;i++){
		Available[i]-=request[i];
		Allocation[p_no][i]+=request[i];
		Need[p_no][i]-=request[i];
	}
	PrintSystemSnapshot();
	if(Safety()==-1){
		printf("\n Unsafe, Do not grant!Restore the allocation state!");
		for(int i=0;i<NUMBER_OF_RESOURCE;i++){
			Available[i]+=request[i];
			Allocation[p_no][i]-=request[i];
			Need[p_no][i]+=request[i];
			}
		}else printf("\n Safe!Grant the request");
		L1:
		printf("\n Continue the Banker's algorithm?(yes=y or Y)");
		contiue_flag=getche();
	}while(contiue_flag=='y'||contiue_flag=='Y');
	Exit:
		return 0;
}