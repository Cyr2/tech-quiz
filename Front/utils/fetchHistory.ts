export async function fetchHistory(historyId: number) {
  try {
      const response = await fetch(`/history.json`);
      
      if (!response.ok) {
          throw new Error(`Erreur HTTP: ${response.status}`);
      }

      const data = await response.json();
      const history = data.history.find((currHistory: any) => currHistory.history_id.toString() === historyId.toString());

      return history;
  } catch (error) {
      console.error('Erreur lors de la récupération du history:', error);
      throw error;
  }
}
